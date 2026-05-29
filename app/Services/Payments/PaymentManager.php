<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGatewayInterface;

class PaymentManager
{
    public function driver(?string $gateway = null): PaymentGatewayInterface
    {
        $gateway = $gateway ?? config('payments.default');

        return match ($gateway) {

            'razorpay' => app(RazorpayService::class),

            default => throw new \Exception(
                "Unsupported payment gateway"
            )
        };
    }
}