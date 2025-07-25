<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TwilioService
{
    protected $sid;
    protected $authToken;
    protected $from;

    public function __construct()
    {
        $this->sid = env('TWILIO_SID');
        $this->authToken = env('TWILIO_AUTH_TOKEN');
        $this->from = env('TWILIO_PHONE');
    }

    public function sendSms($to, $message)
    {
        $url = "https://api.twilio.com/2010-04-01/Accounts/{$this->sid}/Messages.json";

        $response = Http::withBasicAuth($this->sid, $this->authToken)
            ->post($url, [
                'From' => $this->from,
                'To' => $to,
                'Body' => $message,
            ]);

        if ($response->successful()) {
            return [
                'success' => true,
                'message' => 'SMS sent successfully.',
                'data' => $response->json(),
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to send SMS.',
                'error' => $response->json(),
        ];
    }
}
