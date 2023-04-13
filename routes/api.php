<?php

use App\Http\Controllers\{UserController, AuthController, ShipController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');

    Route::post('otp-verification', [AuthController::class, 'verifyOtp'])->middleware(['auth.jwt', 'permission:user.verify.otp'])->name('auth.verify_otp');
});

Route::group(['prefix' => 'users', 'middleware' => ['auth.jwt']], function () {
    Route::post('verify', [UserController::class, 'verifyUser'])->middleware(['permission:user.verify'])->name('users.verify');
});

Route::group(['prefix' => 'ships', 'middleware' => ['auth.jwt']], function () {
    Route::post('register', [ShipController::class, 'registerShip'])->middleware(['permission:ship.register'])->name('ships.register');
});
