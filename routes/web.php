<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchProductsController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SearchProductsController::class, 'index']);

Route::post('/cart', [CartController::class, 'store']);

Route::get('/cart', [CartController::class, 'index']);

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/summary', function () {
    return view('summary');
});
