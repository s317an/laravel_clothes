<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LineltemController;
use App\Http\Controllers\CartController;
use App\Models\Product;

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

Route::controller(ProductController::class)->group(function(){
    Route::name('product.') -> group(function(){
        Route::get('/','index')->name('index');
        Route::get('/product/{id}','show')->name('show');
    });
});

Route::controller(LineltemController::class)->group(function(){
    Route::name('line_ltem.') -> group(function(){
        Route::post('/line_ltem','create')->name('create');
        Route::post('/line_ltem/delete','delete')->name('delete');
    });
});

Route::controller(CartController::class)->group(function(){
    Route::name('cart.') -> group(function(){
        Route::get('/cart','index')->name('index');
        Route::get('/cart/checkout','checkout')->name('checkout');
    });
});

