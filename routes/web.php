<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Shop/Index.vue');
});
Route::resource('/shop', ShopController::class);
Route::get('/register', [AuthController::class, 'RegisterView'])->name('auth.registerView');
Route::post('/register', [AuthController::class, 'Register'])->name('auth.register');

Route::get('/login', [AuthController::class, 'LoginView'])->name('auth.login');
