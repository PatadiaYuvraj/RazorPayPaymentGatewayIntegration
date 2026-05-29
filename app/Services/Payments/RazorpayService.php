<?php

namespace App\Services\Payments;

use Razorpay\Api\Api;
use App\Contracts\PaymentGatewayInterface;
use App\DTOs\CreateOrderData;
use App\DTOs\RefundData;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayService implements PaymentGatewayInterface
{
    protected Api $api;

    public function __construct()
    {
        $this->api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
    }

    public function createOrder(CreateOrderData $data): array
    {
        $order = $this->api->order->create([
            'amount' => $data->amount,
            'currency' => $data->currency,
            'receipt' => $data->receipt,
            'notes' => $data->notes
        ]);

        return $order->toArray();
    }

    public function fetchOrder(string $orderId): array
    {
        return $this->api->order
            ->fetch($orderId)
            ->toArray();
    }

    public function fetchAllOrders(array $filters = []): array
    {
        return $this->api->order
            ->all($filters)
            ->toArray();
    }

    public function fetchPayment(string $paymentId): array
    {
        return $this->api->payment
            ->fetch($paymentId)
            ->toArray();
    }

    public function fetchAllPayments(array $filters = []): array
    {
        return $this->api->payment
            ->all($filters)
            ->toArray();
    }

    public function refundPayment(RefundData $data): array
    {
        $refund = $this->api->payment
            ->fetch($data->paymentId)
            ->refund([
                'amount' => $data->amount,
                'notes' => $data->notes
            ]);

        return $refund->toArray();
    }

    public function fetchRefund(string $refundId): array
    {
        return $this->api->refund
            ->fetch($refundId)
            ->toArray();
    }

    public function fetchAllRefunds(array $filters = []): array
    {
        return $this->api->refund
            ->all($filters)
            ->toArray();
    }

    public function verifyPaymentSignature(array $payload): bool
    {
        try {

            $this->api->utility
                ->verifyPaymentSignature($payload);

            return true;
        } catch (SignatureVerificationError $e) {

            return false;
        }
    }

    public function fetchSettlements(
        string $paymentId
    ): array {

        try {

            /*
        Fetch payment first
        */

            $payment =
                $this->api
                ->payment
                ->fetch($paymentId)
                ->toArray();

            /*
        Razorpay may provide
        settlement_id after settlement
        processing
        */

            $settlementId =
                $payment['settlement_id']
                ?? null;

            /*
        If payment is not settled yet
        */

            if (!$settlementId) {

                return [
                    'status' => 'pending',
                    'settled' => false,
                    'settlement_id' => null,
                    'settled_at' => null,
                    'payment_id' => $paymentId,
                    'amount' => $payment['amount'],
                ];
            }

            /*
        Fetch actual settlement entity
        */

            $settlement =
                $this->api
                ->settlement
                ->fetch($settlementId)
                ->toArray();

            return [

                'status' =>
                $settlement['status']
                    ?? 'processed',

                'settled' => true,

                'settlement_id' =>
                $settlement['id']
                    ?? $settlementId,

                'settled_at' =>
                $settlement['created_at']
                    ?? null,

                'payment_id' =>
                $paymentId,

                'amount' =>
                $settlement['amount']
                    ?? $payment['amount'],

                'utr' =>
                $settlement['utr']
                    ?? null,

            ];
        } catch (\Exception $e) {

            return [

                'status' => 'error',

                'settled' => false,

                'message' =>
                $e->getMessage(),

                'payment_id' =>
                $paymentId

            ];
        }
    }
}
