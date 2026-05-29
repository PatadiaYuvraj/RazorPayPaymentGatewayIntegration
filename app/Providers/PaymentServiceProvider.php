<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Payments\PaymentManager;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            PaymentManager::class,
            fn () => new PaymentManager()
        );
    }
}