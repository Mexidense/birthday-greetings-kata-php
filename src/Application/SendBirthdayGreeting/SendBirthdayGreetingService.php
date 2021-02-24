<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Application\SendBirthdayGreeting;

use BirthdayGreetingsKata\Domain\Model\EmployeeRepository;
use BirthdayGreetingsKata\Domain\Model\XDate;

final class SendBirthdayGreetingService
{
    private EmployeeRepository $employeeRepository;
    private SendBirthdayGreetingMessenger $messenger;

    public function __construct(
        EmployeeRepository $employeeRepository,
        SendBirthdayGreetingMessenger $messenger
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->messenger = $messenger;
    }

    public function sendGreetings(XDate $xDate): void
    {
        $employees = $this->employeeRepository->findAllEmployeesWhoBirthdayIs($xDate);

        foreach ($employees as $employee) {
            $this->messenger->sendMessage(new SendBirthdayGreeting($employee->getEmail(), $employee->getFirstName()));
        }
    }
}
