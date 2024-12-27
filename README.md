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

## Following the instructions
The instructions said I needed to add this line to the `ProductSeeder.php` file: 
`use DB;`

But I actually needed to add:
`use Illuminate\Support\Facades\DB;`


===============

I'm stuck about 40% of the way down, on the CartTest.php => 
public function items_added_to_the_cart_can_be_seen_in_the_cart_page()

For whatever reason, I'm not returning a view. I should figure out why that's happening.  Another idea is to look at the "tdd" branch.  Or skip the entire test.
I'm getting this error:
Time: 00:00.309, Memory: 32.00 MB

There was 1 failure:

1) Tests\Feature\CartTest::test_items_added_to_the_cart_can_be_seen_in_the_cart_page
The response is not a view.

/Users/davidgardner/code/food-order-app-laravel-try2/vendor/laravel/framework/src/Illuminate/Testing/TestResponse.php:1068
/Users/davidgardner/code/food-order-app-laravel-try2/vendor/laravel/framework/src/Illuminate/Testing/TestResponse.php:998
/Users/davidgardner/code/food-order-app-laravel-try2/tests/Feature/CartTest.php:106

FAILURES!
Tests: 4, Assertions: 7, Failures: 1.