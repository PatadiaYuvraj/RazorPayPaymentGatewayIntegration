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
        $this->api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
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

    public function fetchPayment(string $paymentId): array
    {
        return $this->api->payment->fetch($paymentId)->toArray();
    }

    public function fetchAllPayments(array $filters = []): array
    {
        return $this->api->payment->all($filters)->toArray();
    }

    public function refundPayment(RefundData $data): array
    {
        $refund = $this->api->payment->fetch($data->paymentId)->refund([
            'amount' => $data->amount,
            'notes' => $data->notes
        ]);

        return $refund->toArray();
    }

    public function fetchRefund(string $refundId): array
    {
        return $this->api->refund->fetch($refundId)->toArray();
    }

    public function fetchRefunds(string $paymentId): array
    {
        $refunds = $this->api->payment->fetch($paymentId)->refunds();
        return $refunds->toArray()['items'];
    }

    public function verifyPayment(array $data): bool
    {
        try {
            $attributes = [
                'razorpay_order_id' => $data['razorpay_order_id'],
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_signature' => $data['razorpay_signature']
            ];
            $this->api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
