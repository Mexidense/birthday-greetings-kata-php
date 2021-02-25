<?php

declare(strict_types = 1);

namespace BirthdayGreetingsKata\Infrastructure\Persistence\InMemory;

use BirthdayGreetingsKata\Domain\Model\Employee;
use BirthdayGreetingsKata\Domain\Model\EmployeeRepository;
use BirthdayGreetingsKata\Domain\Model\XDate;

final class InMemoryEmployeeRepository implements EmployeeRepository
{
    private array $employees;

    public function __construct()
    {
        $this->employees = [
            [
                'Doe',
                'John',
                '1982/10/08',
                'john.doe@foobar.com',
            ],
            [
                'Ann',
                'Mary',
                '1975/03/11',
                'mary.ann@foobar.com',
            ],
        ];
    }

    public function findAllEmployeesWhoBirthdayIs(XDate $xDate): array
    {
        $employees = [];

        foreach ($this->employees as $employee) {
            $employee = new Employee($employee[1], $employee[0], $employee[2], $employee[3]);

            if ($employee->isBirthday($xDate)) {
                $employees[] = $employee;
            }
        }

        return $employees;
    }
}
