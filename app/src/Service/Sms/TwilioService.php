<?php

namespace App\Service\Sms;

use Twilio\Rest\Client;

class TwilioService
{
    public function __construct(
//        private string $sid,
//        private string $token,
//        private string $from
    ) {}

    public function sendSms(string $to, string $message): void
    {
        $sid = 'AC2429939da6b42585c989b6182fe14d28';
        $token = '9fade3832b81d6b1d01d31aeef2bd0f9';
        $from = '+18446100332';
        $client = new Client($sid, $token);
        $client->messages->create($to, [
            'from' => $from,
            'body' => $message,
        ]);
    }
}
