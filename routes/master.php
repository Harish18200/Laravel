<?php

use App\Http\Controllers\Masters\BankController;
use App\Http\Controllers\Masters\BloodGroupController;
use App\Http\Controllers\Masters\PaymentModeController;
use Illuminate\Support\Facades\Route;


   
Route::resource('blood-groups', BloodGroupController::class);
Route::resource('bank', BankController::class);
Route::resource('paymentMode', PaymentModeController::class);

