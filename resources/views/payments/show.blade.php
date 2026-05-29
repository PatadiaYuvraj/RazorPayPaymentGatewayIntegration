<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Payment Details
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px;
            background:
                linear-gradient(135deg,
                    #0f172a,
                    #111827,
                    #1e293b);
            font-family: Arial, sans-serif;
            color: white;
        }

        .container {
            max-width: 1400px;
            margin: auto;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 34px;
            font-weight: bold;
        }

        .back-btn {
            background: white;
            color: black;
            padding: 12px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.2s;
        }

        .back-btn:hover {
            transform: translateY(-2px);
        }

        .grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border:
                1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            overflow: hidden;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .card-header {
            padding: 24px 28px;
            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);
            font-size: 20px;
            font-weight: bold;
        }

        .card-body {
            padding: 28px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-table td {
            padding: 18px 0;
            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);
            vertical-align: top;
        }

        .details-table tr:last-child td {
            border-bottom: none;
        }

        .label {
            width: 250px;
            color: #94a3b8;
            font-size: 14px;
        }

        .value {
            font-weight: bold;
            word-break: break-word;
        }

        .small-text {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 6px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .success {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
        }

        .failed {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
        }

        .pending {
            background: rgba(251, 191, 36, 0.15);
            color: #facc15;
        }

        .refunded {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
        }

        .error {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
        }

        .amount-box {
            margin-bottom: 20px;
        }

        .amount {
            font-size: 40px;
            font-weight: bold;
        }

        .sub-text {
            color: #94a3b8;
            margin-top: 6px;
        }

        .stat-box {
            background:
                rgba(255, 255, 255, 0.04);
            border:
                1px solid rgba(255, 255, 255, 0.06);
            border-radius: 18px;
            padding: 22px;
            margin-bottom: 18px;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
        }

        .refund-form {
            margin-top: 25px;
        }

        .refund-label {
            display: block;
            margin-bottom: 12px;
            color: #cbd5e1;
            font-size: 14px;
        }

        .input-group {
            display: flex;
            gap: 12px;
        }

        .refund-input {
            flex: 1;
            padding: 16px;
            border-radius: 14px;
            border:
                1px solid rgba(255, 255, 255, 0.08);
            background:
                rgba(255, 255, 255, 0.06);
            color: white;
            font-size: 16px;
            outline: none;
        }

        .refund-input:focus {
            border-color: #3b82f6;
            box-shadow:
                0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .refund-input::placeholder {
            color: #94a3b8;
        }

        .refund-btn {
            background:
                linear-gradient(135deg,
                    #dc2626,
                    #ef4444);
            border: none;
            color: white;
            padding: 16px 24px;
            border-radius: 14px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .refund-btn:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            color: #4ade80;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .timeline {
            position: relative;
            margin-top: 10px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 9px;
            top: 0;
            bottom: 0;
            width: 2px;
            background:
                rgba(255, 255, 255, 0.12);
        }

        .timeline-item {
            position: relative;
            padding-left: 40px;
            margin-bottom: 28px;
        }

        .timeline-dot {
            position: absolute;
            left: 0;
            top: 4px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #3b82f6;
        }

        .timeline-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .timeline-time {
            color: #94a3b8;
            font-size: 13px;
        }

        @media(max-width: 1000px) {

            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 700px) {

            body {
                padding: 20px;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .input-group {
                flex-direction: column;
            }

            .refund-btn {
                width: 100%;
            }

            .page-title {
                font-size: 28px;
            }
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="top-bar">

            <div class="page-title">
                Payment Details
            </div>

            <a href="{{ route('payments.index') }}" class="back-btn">
                ← Back To Payments
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @php

            $capturedAmount = $payment['amount'];

            $refundedAmount = $payment['amount_refunded'] ?? 0;

            $remainingRefundable = ($capturedAmount - $refundedAmount) / 100;
        @endphp

        <div class="grid">

            <div class="card">

                <div class="card-header">
                    Transaction Information
                </div>

                <div class="card-body">

                    <table class="details-table">

                        <tr>
                            <td class="label">
                                Payment ID
                            </td>

                            <td class="value">
                                {{ $payment['id'] }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">
                                Order ID
                            </td>

                            <td class="value">
                                {{ $payment['order_id'] ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">
                                Payment Method
                            </td>

                            <td class="value">
                                {{ strtoupper($payment['method'] ?? '-') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">
                                Email
                            </td>

                            <td class="value">
                                {{ $payment['email'] ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">
                                Contact
                            </td>

                            <td class="value">
                                {{ $payment['contact'] ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">
                                Captured
                            </td>

                            <td class="value">

                                {{ $payment['captured'] ? 'YES' : 'NO' }}

                            </td>
                        </tr>

                        <tr>
                            <td class="label">
                                Created At
                            </td>

                            <td class="value">

                                {{ date('d M Y h:i:s A', $payment['created_at']) }}

                            </td>
                        </tr>

                    </table>

                </div>

            </div>

            <div>

                <div class="stat-box">

                    <div class="stat-label">
                        Payment Amount
                    </div>

                    <div class="amount">

                        ₹{{ number_format($capturedAmount / 100, 2) }}

                    </div>

                    <div class="sub-text">
                        Original transaction amount
                    </div>

                </div>

                <div class="stat-box">

                    <div class="stat-label">
                        Refunded Amount
                    </div>

                    <div class="stat-value">

                        ₹{{ number_format($refundedAmount / 100, 2) }}

                    </div>

                </div>

                <div class="stat-box">

                    <div class="stat-label">
                        Remaining Refundable
                    </div>

                    <div class="stat-value">

                        ₹{{ number_format($remainingRefundable, 2) }}

                    </div>

                </div>

                <div class="stat-box">

                    <div class="stat-label">
                        Payment Status
                    </div>

                    <div>

                        @if ($payment['status'] === 'captured')
                            <span class="badge success">
                                CAPTURED
                            </span>
                        @elseif($payment['status'] === 'failed')
                            <span class="badge failed">
                                FAILED
                            </span>
                        @else
                            <span class="badge pending">

                                {{ strtoupper($payment['status']) }}

                            </span>
                        @endif

                    </div>

                </div>

                <div class="stat-box">

                    <div class="stat-label">
                        Settlement Status
                    </div>

                    <div>

                        @if ($settlement['status'] === 'processed')
                            <span class="badge success">
                                SETTLED
                            </span>
                        @elseif($settlement['status'] === 'pending')
                            <span class="badge pending">
                                PENDING
                            </span>
                        @else
                            <span class="badge error">

                                {{ strtoupper($settlement['status']) }}

                            </span>
                        @endif

                    </div>

                    <div class="small-text">

                        Settlement ID:
                        {{ $settlement['settlement_id'] ?? '-' }}

                    </div>

                </div>

            </div>

            @if ($payment['status'] === 'captured' && $remainingRefundable > 0)
                <div class="card full-width">

                    <div class="card-header">
                        Refund Payment
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('payments.update', $payment['id']) }}"
                            class="refund-form">

                            @csrf

                            @method('PUT')

                            <label class="refund-label">
                                Refund Amount
                            </label>

                            <div class="input-group">

                                <input type="number" name="refund_amount" class="refund-input" min="1"
                                    max="{{ $remainingRefundable }}" step="0.01" placeholder="Enter refund amount"
                                    required>

                                <button type="submit" class="refund-btn"
                                    onclick="
                                    return confirm(
                                        'Process refund?'
                                    )
                                ">
                                    Process Refund
                                </button>

                            </div>

                            <div class="small-text">

                                Maximum refundable:
                                ₹{{ number_format($remainingRefundable, 2) }}

                            </div>

                        </form>

                    </div>

                </div>
            @endif

            <div class="card full-width">

                <div class="card-header">
                    Payment Timeline
                </div>

                <div class="card-body">

                    <div class="timeline">

                        <div class="timeline-item">

                            <div class="timeline-dot"></div>

                            <div class="timeline-title">
                                Payment Created
                            </div>

                            <div class="timeline-time">

                                {{ date('d M Y h:i:s A', $payment['created_at']) }}

                            </div>

                        </div>

                        @if ($payment['captured'])
                            <div class="timeline-item">

                                <div class="timeline-dot"></div>

                                <div class="timeline-title">
                                    Payment Captured
                                </div>

                                <div class="timeline-time">
                                    Transaction captured successfully
                                </div>

                            </div>
                        @endif

                        @if ($refundedAmount > 0)
                            <div class="timeline-item">

                                <div class="timeline-dot"></div>

                                <div class="timeline-title">
                                    Refund Processed
                                </div>

                                <div class="timeline-time">

                                    ₹{{ number_format($refundedAmount / 100, 2) }}
                                    refunded

                                </div>

                            </div>
                        @endif

                        @if ($settlement['status'] === 'processed')

                            <div class="timeline-item">

                                <div class="timeline-dot"></div>

                                <div class="timeline-title">
                                    Settlement Completed
                                </div>

                                <div class="timeline-time">

                                    @if (!empty($settlement['settled_at']))
                                        {{ date('d M Y h:i:s A', $settlement['settled_at']) }}
                                    @else
                                        Settled successfully
                                    @endif

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
