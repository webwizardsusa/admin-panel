<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\CustomerController;

Route::match(['get', 'post'], '/', [AuthController::class, 'login'])->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::resource('customer', CustomerController::class);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::match(['get', 'put'], 'profile', [AccountController::class, 'profile']);
});