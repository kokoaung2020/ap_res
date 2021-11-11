<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DishesController;

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

Route::get('/', [App\Http\Controllers\OrderController::class,'index'])->name('order.form');

Route::post('search', [App\Http\Controllers\OrderController::class,'search'])->name('order.search');

Route::post('order_submit', [App\Http\Controllers\OrderController::class,'submit'])->name('order.submit');

Route::resource('dish', App\Http\Controllers\DishesController::class);
Route::get('order', [App\Http\Controllers\DishesController::class,'order'])->name('kitchen.order');


Route::resource('category', App\Http\Controllers\CategoriesController::class);

Route::get('order/{order}/approve', [App\Http\Controllers\DishesController::class,'approve']);
Route::get('order/{order}/cancel', [App\Http\Controllers\DishesController::class,'cancel'])->name('kitchen.order');
Route::get('order/{order}/ready', [App\Http\Controllers\DishesController::class,'ready'])->name('kitchen.order');

Route::get('order/{order}/serve', [App\Http\Controllers\OrderController::class,'serve'])->name('kitchen.order');

Route::get('main', [App\Http\Controllers\OrderController::class,'main'])->name('order.main');
Route::get('burmese', [App\Http\Controllers\OrderController::class,'burmese'])->name('order.burmese');
Route::get('japanese', [App\Http\Controllers\OrderController::class,'japanese'])->name('order.japanese');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'confirm' => false, // Email Verification Routes...
  ]);
