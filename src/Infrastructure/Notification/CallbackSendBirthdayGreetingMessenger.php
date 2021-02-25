<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Infrastructure\Notification;

use BirthdayGreetingsKata\Application\SendBirthdayGreeting\SendBirthdayGreeting;
use BirthdayGreetingsKata\Application\SendBirthdayGreeting\SendBirthdayGreetingMessenger;

final class CallbackSendBirthdayGreetingMessenger implements SendBirthdayGreetingMessenger
{
    /** @var callable */
    private $callback;

    public function __construct(callable $callable)
    {
        $this->callback = $callable;
    }

    public function sendMessage(SendBirthdayGreeting $sendBirthdayGreeting): void
    {
        $callable = $this->callback;
        $callable($sendBirthdayGreeting);
    }
}
