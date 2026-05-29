<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/razorpay-test', [PaymentController::class, 'checkout']);
// Route::post('/razorpay/order', [PaymentController::class, 'createOrder'])->name('razorpay.order');
// Route::post('/razorpay/verify', [PaymentController::class, 'verifyPayment'])->name('razorpay.verify');
// Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
// Route::post('/payments/refund/{paymentId}', [PaymentController::class, 'refund'])->name('payments.refund');

Route::resource(
    'payments',
    PaymentController::class
);