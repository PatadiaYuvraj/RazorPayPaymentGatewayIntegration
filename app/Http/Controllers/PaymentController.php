<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DTOs\CreateOrderData;
use App\DTOs\RefundData;
use App\Services\Payments\PaymentManager;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentManager $paymentManager
    ) {}

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $payments = $this->paymentManager
            ->driver()
            ->fetchAllPayments([
                'count' => 50
            ]);

        return view(
            'payments.index',
            [
                'payments' => $payments['items'] ?? []
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $paymentMethods = [
            'razorpay' => 'Razor Pay'
        ];

        return view(
            'payments.create',
            compact('paymentMethods')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:1'
            ],
            'gateway' => [
                'required'
            ]
        ]);

        $gateway = $this->paymentManager
            ->driver($request->gateway);

        /*
        Convert rupees to paise
        */

        $amount =
            intval(
                round(
                    $request->amount * 100
                )
            );

        $order = $gateway->createOrder(
            new CreateOrderData(
                amount: $amount,
                receipt: 'ORDER_' . time(),
                notes: [
                    'source' => 'admin-panel'
                ]
            )
        );

        return response()->json([
            'success' => true,
            'gateway' => $request->gateway,
            'key' => config('services.razorpay.key'),
            'order' => $order
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(string $id)
    {
        $gateway = $this->paymentManager->driver();
        $payment = $gateway->fetchPayment($id);
        $settlements = $gateway->fetchSettlements($id);
        return view(
            'payments.show',
            [
                'payment' => $payment,
                'settlement' => $settlements ?? []
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | REFUND
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        string $id
    ) {

        $request->validate([
            'refund_amount' => [
                'required',
                'numeric',
                'min:1'
            ]
        ]);

        try {

            $gateway = $this->paymentManager
                ->driver();

            $payment = $gateway
                ->fetchPayment($id);

            $capturedAmount =
                $payment['amount'];

            $alreadyRefunded =
                $payment['amount_refunded'] ?? 0;

            $remainingRefundable =
                $capturedAmount - $alreadyRefunded;

            $refundAmount =
                intval(
                    round(
                        $request->refund_amount * 100
                    )
                );

            if (
                $refundAmount
                >
                $remainingRefundable
            ) {

                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Refund exceeds refundable amount'
                    );
            }

            $gateway->refundPayment(
                new RefundData(
                    paymentId: $id,
                    amount: $refundAmount
                )
            );

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Refund successful'
                );
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }
}
