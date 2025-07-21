<?php

namespace App\MessageHandler;

use App\Message\SendSmsMessage;
use App\Service\Sms\TwilioService;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendSmsMessageHandler
{
    public function __construct(
        private readonly TwilioService   $twilioService,
        private readonly LoggerInterface $logger
    )
    {
    }

    public function __invoke(SendSmsMessage $message)
    {
        try {
            $this->twilioService->sendSms($message->phoneNumber, $message->message);
        } catch (Exception $e) {
            $this->logger->error('SMS sending failed', [
                    'exception' => $e,
                    'phone' => $message->phoneNumber,
                ]
            );
        }
    }
}
