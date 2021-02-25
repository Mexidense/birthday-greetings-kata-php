<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Infrastructure\Notification;

use BirthdayGreetingsKata\Application\SendBirthdayGreeting\SendBirthdayGreeting;
use BirthdayGreetingsKata\Application\SendBirthdayGreeting\SendBirthdayGreetingMessenger;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

final class SwiftMailerSendBirthdayGreetingMessenger implements SendBirthdayGreetingMessenger
{
    private const SMTP_HOST = '127.0.0.1';
    private const SMTP_PORT = '1025';

    private Swift_Mailer $mailer;

    public function __construct()
    {
        $this->mailer = new Swift_Mailer(new Swift_SmtpTransport(self::SMTP_HOST, self::SMTP_PORT));
    }

    public function sendMessage(SendBirthdayGreeting $sendBirthdayGreeting): void
    {
        $message = new Swift_Message($sendBirthdayGreeting->subject());
        $message->setFrom(SendBirthdayGreeting::SENDER)
            ->setTo([$sendBirthdayGreeting->email()])
            ->setBody($sendBirthdayGreeting->body());

        $this->mailer->send($message);
    }
}
