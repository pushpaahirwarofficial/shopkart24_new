<?php

// app/Http/Controllers/SmsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sendSms()
    {
        $accountSid = 'AC657b230f536d272d7f4de369a192339b';  // Twilio Account SID
        $authToken = 'ae62f7853048bde5f1fc8c3283b561e4';   // Twilio Auth Token
        $twilioPhoneNumber = '+12184329832';  // Twilio Phone Number
        $toPhoneNumber = '+918989011290'; // Recipient Phone Number
        $message = 'Hello, this is a test message from Twilio using Laravel 10';

        // Send SMS using cURL
        $url = "https://api.twilio.com/2010-04-01/Accounts/{$accountSid}/Messages.json";

        $data = [
            'To' => $toPhoneNumber,
            'From' => $twilioPhoneNumber,
            'Body' => $message,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_USERPWD, "{$accountSid}:{$authToken}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return response()->json(['message' => 'SMS sent successfully!', 'response' => $response]);
    }
}
