# Birthday Greetings kata in PHP

This is a simple refactoring exercise that is meant to teach something about dependency inversion and dependency injection.

This is the initial code for this kata written in PHP.

The documentation: http://matteo.vaccari.name/blog/archives/154

## How to get started

### Requirements

In order to use this Kata boilerplate you need to have installed Docker and Docker Compose.

### Run it

To get started you should create a new project throught composer, based on this repository on packagist

```bash
git clone git@git.cumlouder.com:trainings/birthday-greetings-kata.git
cd birthday-greetings-kata
```

To check that all the tests are passing just execute PHPUnit

```bash
docker-compose up -d
php bin/phpunit
```

Now open your favourite IDE/text editor and start hacking.

---

# The happy coding

I've been coding/playing this Kata in order to focus to implement some concepts about Hexagonal Architecture.

Following some resources:
- [The birthday greetings kata instructions](http://matteo.vaccari.name/blog/archives/154) by Matteo Vaccari 
- [Advanced Web Application Architecture book](https://matthiasnoback.nl/book/advanced-web-application-architecture/) by Matthias Noback

I've tried to apply a project split in layers: Domain, Application & Infrastructure:

```bash
src
├── Application
│   └── SendBirthdayGreeting
│       ├── SendBirthdayGreetingMessenger.php
│       ├── SendBirthdayGreeting.php
│       └── SendBirthdayGreetingService.php
├── app.php
├── Domain
│   └── Model
│       ├── Employee.php
│       ├── EmployeeRepository.php
│       └── XDate.php
└── Infrastructure
    ├── Notification
    │   ├── CallbackSendBirthdayGreetingMessenger.php
    │   └── SwiftMailerSendBirthdayGreetingMessenger.php
    └── Persistence
        ├── Csv
        │   └── CsvEmployeeRepository.php
        └── InMemory
            └── InMemoryEmployeeRepository.php

```

## Tests

The core of Acceptance test haven't been modified, only the usage of SendBirthdayGreetingService.

For the acceptance test, I've used as Fake mailer system a Callback mailer system. For the testing of persistence or to read the "Employees" I've used a In Memory repository.

## Usage

Run

```
composer exec app.php
```

The application send emails to greeting the birthday employees who are its birthday. You could see the emails sent [here](http://localhost:8025).