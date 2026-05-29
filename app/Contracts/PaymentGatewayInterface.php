<?php

namespace App\Contracts;

use App\DTOs\CreateOrderData;
use App\DTOs\RefundData;

interface PaymentGatewayInterface
{
    public function createOrder(CreateOrderData $data): array;

    public function fetchOrder(string $orderId): array;

    public function fetchAllOrders(array $filters = []): array;

    public function fetchPayment(string $paymentId): array;

    public function fetchAllPayments(array $filters = []): array;

    public function refundPayment(RefundData $data): array;

    public function fetchRefund(string $refundId): array;

    public function fetchAllRefunds(array $filters = []): array;

    public function verifyPaymentSignature(array $payload): bool;

    public function fetchSettlements(string $paymentId): array;
}