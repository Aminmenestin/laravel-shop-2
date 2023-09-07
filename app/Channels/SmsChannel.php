<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class SmsChannel{
    public function send($notifiable , Notification $notification){

        // $receptor = $notifiable->cell_phone;
        // $template = 'test';
        // $type = '1';
        // $param1 = $notification->code;

        // $postfeilds = "receptor=$receptor" . '&' . "template=$template" . '&' . "type=$type" . '&' . "param1=$param1" ;
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.ghasedak.me/v2/verification/send/simple",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => $postfeilds,
        //     CURLOPT_HTTPHEADER => array(
        //     "apikey: 1e993e40db7f5f1d9f4adff3bd15484d6c0ce143c805b94bd52125a2730be72e ",
        //     "cache-control: no-cache",
        //     "content-type: application/x-www-form-urlencoded",
        //     ),
        // ));
        // $response = curl_exec($curl);
        // $err = curl_error($curl);
        // curl_close($curl);

    }
}
