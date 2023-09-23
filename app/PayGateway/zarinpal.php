<?php

namespace App\PayGateway;

class zarinpal extends payment
{


    public function send($amounts, $address)
    {

        $data = array(
            'MerchantID' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
            'Amount' => $amounts['paying_amount'],
            'CallbackURL' => route('home.payment.verify' ,['getwayname' => 'zarinpal']),
            'Description' => 'خرید تست'
        );


        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));


        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);

        if ($err) {
            alert()->error('مشکل در پرداخت')->persistent('حله');
            return redirect()->back();
        } else {
            if ($result["Status"] == 100) {


                $createorder = parent::createorder($address, $amounts, $result["Authority"], 'zarinpal');

                if (array_key_exists('error', $createorder)) {
                    return ['error' => $createorder];
                }

                return ['success' => "https://sandbox.zarinpal.com/pg/StartPay/" . $result["Authority"]];
            } else {
                alert()->error('مشکل در پرداخت')->persistent('حله');
                return redirect()->back();
            }
        }
    }


    public function verifyRequest()
    {

        $MerchantID = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';


        $Authority = $_GET['Authority'];

        $data = array('MerchantID' => $MerchantID, 'Authority' => $Authority, 'Amount' => finalamount());
        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == 100) {
                $updateorder = parent::updateorder($Authority, $result['RefID']);
                if (array_key_exists('error', $updateorder)) {
                    return ['error' => $updateorder];
                }

                \Cart::clear();

                return ['success' => 'پرداخت با موفقیت انجام شد'];
            } else {
                return ['error' => 'پرداخت ناموفق '];
            }
        }
    }
}
