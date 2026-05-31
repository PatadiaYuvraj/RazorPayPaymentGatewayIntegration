<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DTOs\{CreateOrderData, RefundData};
use App\Services\Payments\PaymentManager;

class PaymentController extends Controller
{
    public function __construct(protected PaymentManager $paymentManager) {}

    public function index()
    {
        $payments = $this->paymentManager->driver()->fetchAllPayments(['count' => 50]);
        return view('payments.index', ['payments' => $payments['items'] ?? []]);
    }

    public function create()
    {
        $paymentMethods = ['razorpay' => 'Razor Pay'];
        return view('payments.create', compact('paymentMethods'));
    }

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

        $gateway = $this->paymentManager->driver($request->gateway);
        $amount = intval(round($request->amount * 100));
        $order = $gateway->createOrder(new CreateOrderData(amount: $amount, receipt: 'ORDER_' . time(), notes: ['source' => 'admin-panel']));

        return response()->json([
            'success' => true,
            'gateway' => $request->gateway,
            'key' => config('services.razorpay.key'),
            'order' => $order
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => [
                'required'
            ],
            'razorpay_order_id' => [
                'required'
            ],
            'razorpay_signature' => [
                'required'
            ]
        ]);
        try {
            $gateway = $this->paymentManager->driver('razorpay');
            $verified = $gateway->verifyPayment([
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ]);

            if (!$verified) {
                return response()->json([
                    'success' => false,
                    'message' =>
                    'Payment verification failed'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment verified successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function show(string $id)
    {
        $gateway = $this->paymentManager->driver();
        $payment = $gateway->fetchPayment($id);
        $refunds = $gateway->fetchRefunds($id);

        return view('payments.show', ['payment' => $payment, 'refunds' => $refunds]);
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'refund_amount' => [
                'required',
                'numeric',
                'min:1'
            ]
        ]);

        try {

            $gateway = $this->paymentManager->driver();

            $payment = $gateway->fetchPayment($id);

            $capturedAmount = $payment['amount'];

            $alreadyRefunded = $payment['amount_refunded'] ?? 0;

            $remainingRefundable = $capturedAmount - $alreadyRefunded;

            $refundAmount = intval(round($request->refund_amount * 100));

            if ($refundAmount > $remainingRefundable) {
                return redirect()->back()->with('error', 'Refund exceeds refundable amount');
            }
            $gateway->refundPayment(new RefundData(paymentId: $id, amount: $refundAmount));
            return redirect()->back()->with('success', 'Refund successful');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
