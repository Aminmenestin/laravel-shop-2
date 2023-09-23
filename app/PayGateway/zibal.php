<?php

namespace App\PayGateway;

class zibal extends payment
{

    public function send($amounts, $address)
    {

        $data = array(
            'merchant' => 'zibal',
            'amount' => $amounts['paying_amount'].'0',
            'callbackUrl' => route('home.payment.verify' ,['getwayname' => 'zibal']),
            'description' => 'خرید تست'
        );


        $jsonData = json_encode($data);
        $ch = curl_init('https://gateway.zibal.ir/v1/request');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Zibal');
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
            echo "cURL Error #:" . $err;
        } else {
            if ($result["result"] == 100 && $result["message"] == 'success') {


                $createorder = parent::createorder($address, $amounts, $result["trackId"], 'zibal');

                if (array_key_exists('error', $createorder)) {
                    return ['error' => $createorder];
                }

                return ['success' => "https://gateway.zibal.ir/start/" . $result["trackId"]];
            } else {
                echo 'ERR: ' . $result["Status"];
            }
        }
    }


    public function verifyRequest()
    {

        $MerchantID = 'zibal';

        $trackId = $_GET['trackId'];

        $data = array('merchant' => $MerchantID, 'trackId' => $trackId);
        $jsonData = json_encode($data);
        $ch = curl_init('https://gateway.zibal.ir/v1/verify');
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
            if ($result['result'] == 100 && $result['message'] == 'success' && $result['status'] == 1) {

                $updateorder = parent::updateorder($trackId, 'zibal_test_refNumber');
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
