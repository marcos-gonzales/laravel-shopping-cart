<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/register', [AuthController::class, 'RegisterView'])->name('auth.registerView');
Route::post('/register', [AuthController::class, 'Register']);

Route::get('/login', [AuthController::class, 'LoginView'])->name('auth.login');
Route::post('/login', [AuthController::class, 'Login']);

Route::post('/logout', [AuthController::class, 'Logout']);

Route::get('/', function () {
    return Inertia::render('Shop/Index.vue');
});

Route::get('/shop/category/{category}', [CategoryController::class, 'index']);
Route::resource('/shop', ShopController::class);
