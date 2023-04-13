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
    Route::put('edit', [UserController::class, 'editUser'])->middleware(['permission:user.edit'])->name('users.edit');
    Route::delete('delete', [UserController::class, 'deleteUser'])->middleware(['permission:user.delete'])->name('users.delete');
});

Route::group(['prefix' => 'ships'], function () {
    Route::group(['middleware' => ['auth.jwt']], function () {
        Route::post('register', [ShipController::class, 'registerShip'])->middleware(['permission:ship.create'])->name('ships.register');
        Route::post('edit', [ShipController::class, 'editShip'])->middleware(['permission:ship.edit'])->name('ships.edit');
        Route::post('verify', [ShipController::class, 'verifyShip'])->middleware(['permission:ship.verify'])->name('ships.verify');
        Route::delete('delete', [ShipController::class, 'deleteShip'])->middleware(['permission:ship.delete'])->name('ships.delete');
    });
    Route::get('/', [ShipController::class, 'getShip'])->name('ships.get');
});
