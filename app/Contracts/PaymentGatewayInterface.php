<?php

namespace App\Contracts;

use App\DTOs\CreateOrderData;
use App\DTOs\RefundData;

interface PaymentGatewayInterface
{
    public function createOrder(CreateOrderData $data): array;

    public function fetchPayment(string $paymentId): array;

    public function fetchAllPayments(array $filters = []): array;

    public function refundPayment(RefundData $data): array;

    public function fetchRefunds(string $paymentId): array;

    public function verifyPayment(array $payload): bool;
}