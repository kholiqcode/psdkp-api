<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

    Route::post('otp-verification', [AuthController::class, 'verifyOtp'])->middleware('auth.jwt')->name('auth.verify_otp');
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('users/verify', [AdminController::class, 'verifyUser'])->middleware('auth.jwt')->name('admin.users.verify');
});
