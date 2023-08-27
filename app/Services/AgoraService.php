<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Yasser\Agora\RtcTokenBuilder;

class AgoraService
{
    public function generateToken($channel_name)
    {
        return RtcTokenBuilder::buildTokenWithUid(
            config('laravel-agora.agora.app_id'),
            config('laravel-agora.agora.app_certificate'),
            $channel_name,
            0,
            RtcTokenBuilder::RoleAttendee,
            now()->getTimestamp()+86400
        );
    }

    public function initAuth()
    {
        $customerKey = env('AGORA_CUSTOMER_ID');
// Customer secret
        $customerSecret = env('AGORA_CUSTOMER_SECRET');
// Concatenate customer key and customer secret
        $credentials = $customerKey . ":" . $customerSecret;

// Encode with base64
        $base64Credentials = base64_encode($credentials);
// Create authorization header
        $arr_header = "Authorization: Basic " . $base64Credentials;

        $curl = curl_init();
// Send HTTP request
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://console.agora.io/api/v2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',

            CURLOPT_HTTPHEADER => array(
                $arr_header,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            return "Error in cURL : " . curl_error($curl);
        }

        curl_close($curl);

        return $response;
    }
}
