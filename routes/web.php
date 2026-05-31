<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('payments', PaymentController::class);
Route::post('/payments/verify', [PaymentController::class, 'verify'])->name('payments.verify');
