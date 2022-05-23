<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [AuthController::class, 'RegisterView'])->name('auth.registerView');
Route::post('/register', [AuthController::class, 'Register']);

Route::get('/login', [AuthController::class, 'LoginView'])->name('login');
Route::post('/login', [AuthController::class, 'Login']);

Route::post('/logout', [AuthController::class, 'Logout']);

Route::get('/', [ProductController::class, 'index'])->name('shop.index');
Route::resource('/product', ProductController::class);
Route::get('/product/category/{category}', [CategoryController::class, 'index']);
Route::get('/product/{query}', [ProductController::class, 'searchProduct']);

Route::post('/checkout/{product}', [CheckoutController::class, 'store'])->middleware('auth');
Route::get('/checkout/summary', [CheckoutController::class, 'index'])->middleware('auth');
Route::delete('/checkout/{product}', [CheckoutController::class, 'destroy'])->middleware('auth');
