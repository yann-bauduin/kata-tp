# Racing Car Katas

This is the PHP version of the Racing Car Katas.

## Installation

The project uses:

- [PHP 8.0+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org)

Recommended:

- [Git](https://git-scm.com/downloads)

See [GitHub cloning a repository](https://help.github.com/en/articles/cloning-a-repository) for details on how to
create a local copy of this project on your computer.

```sh
git clone git@github.com:emilybache/Racing-Car-Katas.git
```

or

```shell script
git clone https://github.com/emilybache/Racing-Car-Katas.git
```

Install all the dependencies using composer

```sh
cd ./Racing-Car-Katas/php
composer install
```

Run all the tests

```shell script
composer tests
```

## Dependencies

The project uses composer to install:

- [PHPUnit](https://phpunit.de/)
- [PHPStan](https://github.com/phpstan/phpstan)
- [Easy Coding Standard (ECS)](https://github.com/symplify/easy-coding-standard)

## Folders

- `src` - Contains the five exercise:
    - TirePressureMonitoringSystem
    - TextConverter
    - TicketDispenser
    - TelemetrySystem
    - Leaderboard
- `tests` - Contains the corresponding tests

## Testing

PHPUnit is used to run tests, to help this can be run using a composer script. To run the unit tests, from the root of
the project run:

```shell script
composer tests
```

On Windows a batch file has been created, similar to an alias on Linux/Mac (e.g. `alias pu="composer tests"`), the same
`composer tests` can be run:

```shell script
pu.bat
```

### Tests with Coverage Report

To run all test and generate a html coverage report run:

```shell script
composer test-coverage
```

The coverage report is created in /builds, it is best viewed by opening /builds/**index.html** in your browser.

The [XDEbug](https://xdebug.org/download) extension is required for coverage report generating.

## Code Standard

Easy Coding Standard (ECS) is used to check for style and code standards, **PSR-12** is used.

### Check Code

To check code, but not fix errors:

```shell script
composer check-cs
``` 

On Windows a batch file has been created, similar to an alias on Linux/Mac (e.g. `alias cc="composer check-cs"`), the 
same `composer check-cs` can be run:

```shell script
cc.bat
```

### Fix Code

Many code fixes are automatically provided by ECS, if advised to run --fix, the following script can be run:

```shell script
composer fix-cs
```

On Windows a batch file has been created, similar to an alias on Linux/Mac (e.g. `alias fc="composer fix-cs"`), the same 
`composer fix-cs` can be run:

```shell script
fc.bat
```

## Static Analysis

PHPStan is used to run static analysis checks:

```shell script
composer phpstan
```

On Windows a batch file has been created, similar to an alias on Linux/Mac (e.g. `alias ps="composer phpstan"`), the 
same `composer phpstan` can be run:

```shell script
ps.bat
```

**Happy coding**!
