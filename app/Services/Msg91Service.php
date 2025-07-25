<?php 
namespace App\Services;

use GuzzleHttp\Client;

class Msg91Service
{
    protected $client;
    protected $authKey;
    protected $senderId;

    public function __construct()
    {
        $this->client = new Client();
        $this->authKey = env('MSG91_AUTH_KEY'); // Add this to your .env file
        $this->senderId = env('MSG91_SENDER_ID'); // Add this to your .env file
    }

    public function sendSMS($mobile, $message)
    {
        $endpoint = "https://api.msg91.com/api/v5/flow/";

        $payload = [
            'flow_id' => env('MSG91_FLOW_ID'), // Flow ID from MSG91 dashboard
            'sender' => $this->senderId,
            'recipients' => [
                [
                    'mobiles' => $mobile,
                    'message' => $message,
                ],
            ],
        ];

        $headers = [
            'authkey' => $this->authKey,
            'Content-Type' => 'application/json',
        ];

        try {
            $response = $this->client->post($endpoint, [
                'json' => $payload,
                'headers' => $headers,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
