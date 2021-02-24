<?php

declare(strict_types=1);

namespace Tests\BirthdayGreetingsKata;

use BirthdayGreetingsKata\Application\SendBirthdayGreeting\SendBirthdayGreeting;
use BirthdayGreetingsKata\Application\SendBirthdayGreeting\SendBirthdayGreetingService;
use BirthdayGreetingsKata\Domain\Model\XDate;
use BirthdayGreetingsKata\Infrastructure\Notification\CallbackSendBirthdayGreetingMessenger;
use BirthdayGreetingsKata\Infrastructure\Persistence\Csv\CsvEmployeeRepository;
use PHPUnit\Framework\TestCase;
use Swift_Message;

class AcceptanceTest extends TestCase
{
    private array $messagesSent;
    private ?SendBirthdayGreetingService $service;

    public function setUp(): void
    {
        $this->messagesSent = [];
        $this->service = new SendBirthdayGreetingService(
            new CsvEmployeeRepository(__DIR__ . '/resources/employee_data.txt'),
            new CallbackSendBirthdayGreetingMessenger(function ($sendBirthdayGreeting) {
                $message = new Swift_Message($sendBirthdayGreeting->subject());
                $message
                    ->setFrom(SendBirthdayGreeting::SENDER)
                    ->setTo([$sendBirthdayGreeting->email()])
                    ->setBody($sendBirthdayGreeting->body());

                $this->messagesSent[] = [
                    'Content' => [
                        'Body' => $message->getBody(),
                        'Headers' => [
                            'Subject' => array_values([$message->getSubject()]),
                            'To' => array_keys($message->getTo()),
                        ]
                    ],
                ];
            })
        );
    }

    public function tearDown(): void
    {
        $this->service = null;
        $this->messagesSent = [];
    }

    public function testWillSendGreetingsWhensSomebodyIsItsBirthday(): void
    {
        $this->service->sendGreetings(new XDate('2008/10/08'));

        $messages = $this->messagesSent;
        $this->assertCount(1, $messages, 'message not sent?');

        $message = $messages[0];
        $this->assertEquals('Happy Birthday, dear John!', $message['Content']['Body']);
        $this->assertEquals('Happy Birthday!', $message['Content']['Headers']['Subject'][0]);
        $this->assertCount(1, $message['Content']['Headers']['To']);
        $this->assertEquals('john.doe@foobar.com', $message['Content']['Headers']['To'][0]);
    }

    public function testWillNotSendEmailsWhenNobodyIsItsBirthday(): void
    {
        $this->service->sendGreetings(new XDate('2008/01/01'));

        $this->assertCount(0, $this->messagesSent, 'what? messages?');
    }
}
