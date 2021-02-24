<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata\Domain\Model;

interface EmployeeRepository
{
    public function findAllEmployeesWhoBirthdayIs(XDate $xDate): array;
}