<?php

namespace App\Service\Email;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendEmail(string $from,
                              string $to,
                              string $subject,
                              string $content,
                              string $attachmentPath =  null )
    {

        try {
            $email = (new Email())
                ->from($from)
                ->to($to)
                ->subject($subject)
                ->html($content);
            if($attachmentPath) $email->attachFromPath($attachmentPath, 'recu.pdf');
            $this->mailer->send($email);
            return true;
        }catch(\Exception $e){
            return false;
        }

    }

}