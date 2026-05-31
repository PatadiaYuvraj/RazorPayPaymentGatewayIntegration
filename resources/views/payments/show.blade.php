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
            padding: 30px;

            background:
                linear-gradient(135deg,
                    #0f172a,
                    #111827,
                    #1e293b);

            min-height: 100vh;

            font-family: Arial, sans-serif;

            color: white;
        }

        .container {

            width: 100%;
            max-width: 1300px;

            margin: auto;
        }

        .top-bar {

            display: flex;

            justify-content: space-between;

            align-items: center;

            flex-wrap: wrap;

            gap: 15px;

            margin-bottom: 30px;
        }

        .title {

            font-size: 38px;

            font-weight: bold;
        }

        .subtitle {

            color: #94a3b8;

            margin-top: 8px;
        }

        .back-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 16px 24px;

            border-radius: 18px;

            text-decoration: none;

            background:
                rgba(255, 255, 255, 0.08);

            border:
                1px solid rgba(255, 255, 255, 0.08);

            color: white;

            font-weight: bold;

            transition: 0.2s;
        }

        .back-btn:hover {

            transform: translateY(-2px);

            background:
                rgba(255, 255, 255, 0.12);
        }

        .grid {

            display: grid;

            grid-template-columns:
                repeat(auto-fit,
                    minmax(320px, 1fr));

            gap: 24px;
        }

        .card {

            background:
                rgba(255, 255, 255, 0.06);

            border:
                1px solid rgba(255, 255, 255, 0.08);

            border-radius: 28px;

            overflow: hidden;

            backdrop-filter: blur(12px);

            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.35);
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

        .detail-item {

            margin-bottom: 22px;
        }

        .detail-label {

            color: #94a3b8;

            font-size: 13px;

            margin-bottom: 8px;

            text-transform: uppercase;

            letter-spacing: 1px;
        }

        .detail-value {

            font-size: 16px;

            font-weight: bold;

            word-break: break-word;
        }

        .status {

            display: inline-block;

            padding: 10px 16px;

            border-radius: 999px;

            font-size: 12px;

            font-weight: bold;

            text-transform: uppercase;
        }

        .captured {

            background:
                rgba(34, 197, 94, 0.15);

            color: #4ade80;
        }

        .failed {

            background:
                rgba(239, 68, 68, 0.15);

            color: #f87171;
        }

        .pending {

            background:
                rgba(234, 179, 8, 0.15);

            color: #facc15;
        }

        .refund-form {

            margin-top: 15px;
        }

        .input {

            width: 100%;

            padding: 16px;

            border-radius: 16px;

            border:
                1px solid rgba(255, 255, 255, 0.08);

            background:
                rgba(255, 255, 255, 0.05);

            color: white;

            outline: none;

            margin-bottom: 16px;
        }

        .input:focus {

            border-color: #3b82f6;

            box-shadow:
                0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .refund-btn {

            width: 100%;

            border: none;

            padding: 16px;

            border-radius: 16px;

            background:
                linear-gradient(135deg,
                    #dc2626,
                    #ef4444);

            color: white;

            font-weight: bold;

            cursor: pointer;

            transition: 0.2s;
        }

        .refund-btn:hover {

            transform: translateY(-2px);

            opacity: 0.95;
        }

        .table-wrapper {

            overflow-x: auto;
        }

        table {

            width: 100%;

            border-collapse: collapse;
        }

        th {

            text-align: left;

            padding: 18px;

            color: #cbd5e1;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);
        }

        td {

            padding: 18px;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.06);

            color: #e2e8f0;
        }

        .empty {

            color: #94a3b8;

            text-align: center;

            padding: 30px;
        }

        .json-box {

            background:
                rgba(0, 0, 0, 0.35);

            border-radius: 18px;

            padding: 18px;

            overflow-x: auto;

            font-size: 13px;

            line-height: 1.7;
        }
    </style>

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
                        @elseif($payment['status'] === 'refunded')
                            <span class="badge refunded">
                                REFUNDED
                            </span>
                        @else
                            <span class="badge pending">
                                {{ strtoupper($payment['status']) }}
                            </span>
                        @endif

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

                        {{-- Refunded amount use refunds  --}}
                        @foreach ($refunds as $refund)
                            <div class="timeline-item">

                                <div class="timeline-dot"></div>

                                <div class="timeline-title">
                                    Refund Processed
                                </div>

                                <div class="timeline-time">
                                    ₹{{ number_format(($refund['amount'] ?? 0) / 100, 2) }} refunded on
                                    {{ isset($refund['created_at']) ? date('d M Y h:i:s A', $refund['created_at']) : 'N/A' }}
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

            {{-- Refunds --}}

            <div class="card full-width" style="margin-top: 24px;">

                <div class="card-header">
                    Refund History
                </div>

                <div class="card-body">

                    @if (count($refunds))

                        <div class="table-wrapper">

                            <table>

                                <thead>

                                    <tr>

                                        <th>
                                            Refund ID
                                        </th>

                                        <th>
                                            Created At
                                        </th>

                                        <th>
                                            Amount
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($refunds as $refund)
                                        <tr>

                                            <td>
                                                {{ $refund['id'] ?? 'N/A' }}
                                            </td>

                                            <td>

                                                {{ isset($refund['created_at']) ? date('d M Y  h:i:s A', $refund['created_at']) : 'N/A' }}
                                            </td>

                                            <td>

                                                ₹

                                                {{ number_format(
                                                    ($refund['amount'] ?? 0) / 100,
                                                
                                                    2,
                                                ) }}

                                            </td>

                                            <td>

                                                {{ strtoupper($refund['status'] ?? 'N/A') }}

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    @else
                        <div class="empty">
                            No refunds found.
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</body>

</html>
