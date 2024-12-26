# Food Order App Laravel TDD (Try2)

A sample project demonstrating the basics of test-driven development in Laravel: [https://www.honeybadger.io/blog/laravel-tdd/](https://www.honeybadger.io/blog/laravel-tdd/)

This project uses two alias' in the Z-shell, and also requires the MySQL Database Instance to be running

Make sure to set up these alias' at the start
- `alias p='vendor/bin/phpunit'`
- `alias pf='vendor/bin/phpunit --filter'`

Use the alias to execute the PHPUnit tests:
- `pf SearchTest`
- `pf CartTest`

## Progress

Start time: Wed, Dec 25 at 7pm MT

Project setup
I got a ton of "deprecation warnings" once I started the web app. The solution was to update `"php": "^7.3|^8.0"` => `"php": "^8.1"` in the `composer.json` file. I left the `"laravel/framework"` unchanged.

Then ran: `composer update` before running `npm install` and `php artisan serve` to run the web app again. This time now "deprecation warnings"



