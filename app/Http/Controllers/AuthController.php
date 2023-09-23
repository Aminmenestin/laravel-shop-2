<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\OTPSms;
use Illuminate\Support\Facades\Hash;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;


class AuthController extends Controller
{
    public function login(Request $request)
    {

        if (auth()->user()) {
            return redirect()->route('home.index');
        }

        if ($request->method() == 'GET') {
            return view('auth.login');
        }

        $request->validate([
            'cell_phone' => 'required | ir_mobile',
            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('login')]
        ]);


        try {

            $optCode = mt_rand(100000, 999999);

            $login_token = Hash::make('AFGGlakg@#($sl342asdfg345daagl$@(*@$dssdgfFUsdogslgj');

            $user = User::where('cell_phone', $request->cell_phone)->first();

            if ($user) {
                $user->update([
                    'otp' => $optCode,
                    'login_token' => $login_token,
                    'token_expire' => Carbon::now()->addMinutes(2)

                ]);
            } else {

                $userName = 'U_' . mt_rand(10000000, 99999999);

                $user = User::create([
                    'name' => $userName,
                    'cell_phone' => $request->cell_phone,
                    'otp' => $optCode,
                    'login_token' => $login_token,
                    'token_expire' => Carbon::now()->addMinutes(2)
                ]);
            }

            $user->notify(new OTPSms($optCode));

            session()->put('login_token' , ['login_token'=> $login_token  , 'number' => $request->cell_phone]);

            return response(['login_token' => $login_token, 'otp' => $optCode]);

        } catch (\Exception $ex) {
            return response($ex->getMessage(), 422);
        }
    }

    public function checkOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required | digits:6',
            'login_token' => 'required',
            'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('login')]
        ]);


        try {
            $user = User::where('login_token', $request->login_token)->firstOrFail();

            if (Carbon::now() > $user->token_expire) {
                session()->forget('login_token');
                return response(['message' => 'کد یک بار مصرف منقضی شده است'], 422);
            }

            if ($user->otp == $request->otp) {
                auth()->login($user, $remember = true);
                session()->forget('login_token');
                return response(['message' => 'ورود با موفقیت انجام شد'], 200);
            } else {
                return response(['message' => 'کد وارد شده نادرست است'], 422);
            }
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 422);
        }
    }



    public function preventReloading(){
        if(session()->has('login_token')){
            return(['session' => session()->get('login_token')]);
        }
        else{
            return 'null';
        }
    }

    public function wrongNumber(){
       session()->forget('login_token');
    }

}
