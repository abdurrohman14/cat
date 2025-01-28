<?php

namespace App\Helpers;

use Twilio\Rest\Client;

class WhatsAppHelper {
public static function sendWhatsAppMessage($to, $message)
    {
        $sid = env('TWILIO_SID'); // SID Twilio dari .env
        $authToken = env('TWILIO_AUTH_TOKEN'); // Auth Token Twilio dari .env
        $twilioNumber = '+14155238886'; // Nomor WhatsApp Twilio dari .env

        $client = new Client($sid, $authToken);

        $client->messages->create(
            "whatsapp:$to", // Nomor tujuan dengan prefix 'whatsapp:'
            [
                'from' => "whatsapp:$twilioNumber",
                'body' => $message,
            ]
        );
    }
}