<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;

class SmsMisrService
{
    protected $client;
    protected $username;
    protected $password;
    protected $senderId;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->username = env('SMSMISR_USERNAME');
        $this->password = env('SMSMISR_PASSWORD');
        $this->senderId = env('SMSMISR_SENDER_ID');
        $this->apiKey = env('SMSMISR_API_KEY');
    }

    public function sendOTP($phoneNumber, $otpCode)
    {
        try {
            $response = $this->client->post('https://smsmisr.com/api/webapi/?', [
                'form_params' => [
                    'username'  => $this->username,
                    'password'  => $this->password,
                    'sender'    => $this->senderId,
                    'language'  => 1, // 1 for Arabic, 2 for English
                    'message'   => 'Your OTP code is: ' . $otpCode,
                    'mobile'    => $phoneNumber,
                    'apiKey'    => $this->apiKey,
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            if ($result['code'] === '1901') {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            throw new Exception('Error sending OTP: ' . $e->getMessage());
        }
    }
}
