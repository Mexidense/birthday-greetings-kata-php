<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application\SendBirthdayGreeting;

interface SendBirthdayGreetingMessenger
{
    public function sendMessage(SendBirthdayGreeting $sendBirthdayGreeting): void;
}
