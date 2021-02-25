<?php

require 'vendor/autoload.php';

use BirthdayGreetingsKata\Application\SendBirthdayGreeting\SendBirthdayGreetingService;
use BirthdayGreetingsKata\Domain\Model\XDate;
use BirthdayGreetingsKata\Infrastructure\Notification\SwiftMailerSendBirthdayGreetingMessenger;
use BirthdayGreetingsKata\Infrastructure\Persistence\Csv\CsvEmployeeRepository;

$service = new SendBirthdayGreetingService(
    new CsvEmployeeRepository(__DIR__ . '../../resources/employee_data.csv'),
    new SwiftMailerSendBirthdayGreetingMessenger()
);

$service->sendGreetings(new XDate('2021/10/08'));
