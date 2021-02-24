<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Infrastructure\Persistence\Csv;

use BirthdayGreetingsKata\Domain\Model\Employee;
use BirthdayGreetingsKata\Domain\Model\EmployeeRepository;
use BirthdayGreetingsKata\Domain\Model\XDate;

final class CsvEmployeeRepository implements EmployeeRepository
{
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function findAllEmployeesWhoBirthdayIs(XDate $xDate): array
    {
        $employees = [];

        $fileHandler = fopen($this->filename, 'r');
        fgetcsv($fileHandler);

        while ($employeeData = fgetcsv($fileHandler, null)) {
            $employeeData = array_map('trim', $employeeData);
            $employee = new Employee($employeeData[1], $employeeData[0], $employeeData[2], $employeeData[3]);

            if ($employee->isBirthday($xDate)) {
                $employees[] = $employee;
            }
        }

        fclose($fileHandler);

        return $employees;
    }
}