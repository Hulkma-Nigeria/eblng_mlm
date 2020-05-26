<?php


namespace App\Traits;


trait Curl
{
    protected $api;
    public function curl($endpoint, $data = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api.$endpoint);
        $headers = [
            'Authorization: '.'Bearer '.config('paystack.secretKey'),
            'Content-Type: application/json',
        ];
        if (sizeof($data)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));  //Post Fields
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        if(curl_error($ch)){
            echo 'error:' . curl_error($ch);
        }
        curl_close ($ch);
        return json_decode($server_output);
    }
}
