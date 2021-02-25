<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application\SendBirthdayGreeting;

final class SendBirthdayGreeting
{
    public const SENDER = 'happy_birthday@domain.com';

    private string $email;
    private string $firstName;

    public function __construct(string $email, string $firstName)
    {
        $this->email = $email;
        $this->firstName = $firstName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function body(): string
    {
        return sprintf('Happy Birthday, dear %s!', $this->firstName);
    }

    public function subject(): string
    {
        return sprintf('Happy Birthday!');
    }
}
