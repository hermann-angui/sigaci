<?php
namespace App\Message;


class SendSmsMessage
{
    public function __construct(
        public readonly string $phoneNumber,
        public readonly string $message
    ) {}
}
