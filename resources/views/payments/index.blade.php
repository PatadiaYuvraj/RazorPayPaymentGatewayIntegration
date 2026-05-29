<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Payments Admin
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
            max-width: 1500px;
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

        .create-btn {
            background: white;
            color: black;
            padding: 12px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.2s;
        }

        .create-btn:hover {
            transform: translateY(-2px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border:
                1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 24px;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .stat-label {
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
        }

        .table-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border:
                1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            overflow: hidden;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .table-header {
            padding: 22px 25px;
            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);
            font-size: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(255, 255, 255, 0.04);
        }

        th {
            padding: 18px;
            text-align: left;
            color: #94a3b8;
            font-size: 13px;
            letter-spacing: 0.5px;
            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);
        }

        td {
            padding: 18px;
            border-bottom:
                1px solid rgba(255, 255, 255, 0.06);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .payment-id {
            font-weight: bold;
            font-size: 14px;
        }

        .small-text {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 5px;
        }

        .amount {
            font-size: 18px;
            font-weight: bold;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: bold;
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

        .view-btn {
            background:
                linear-gradient(135deg,
                    #2563eb,
                    #3b82f6);
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: bold;
            transition: 0.2s;
            display: inline-block;
        }

        .view-btn:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        .empty-state {
            padding: 60px;
            text-align: center;
            color: #94a3b8;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: white;
        }

        @media(max-width: 1200px) {

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .table-card {
                overflow-x: auto;
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

            .stats-grid {
                grid-template-columns: 1fr;
            }

            table {
                min-width: 900px;
            }
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="top-bar">

            <div class="page-title">
                Payments Admin
            </div>

            <a href="{{ route('payments.create') }}" class="create-btn">
                + Create Payment
            </a>

        </div>

        @php

            $totalPayments = count($payments);

            $capturedPayments = collect($payments)->where('status', 'captured')->count();

            $failedPayments = collect($payments)->where('status', 'failed')->count();

            $totalRevenue = collect($payments)->sum('amount') / 100;

        @endphp

        <div class="stats-grid">

            <div class="stat-card">

                <div class="stat-label">
                    Total Payments
                </div>

                <div class="stat-value">
                    {{ $totalPayments }}
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-label">
                    Captured Payments
                </div>

                <div class="stat-value">
                    {{ $capturedPayments }}
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-label">
                    Failed Payments
                </div>

                <div class="stat-value">
                    {{ $failedPayments }}
                </div>

            </div>

            <div class="stat-card">

                <div class="stat-label">
                    Total Revenue
                </div>

                <div class="stat-value">

                    ₹{{ number_format($totalRevenue, 2) }}

                </div>

            </div>

        </div>

        <div class="table-card">

            <div class="table-header">
                Recent Payments
            </div>

            <table>

                <thead>

                    <tr>

                        <th>
                            Payment
                        </th>

                        <th>
                            Amount
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Method
                        </th>

                        <th>
                            Refunded
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($payments as $payment)
                        <tr>

                            <td>

                                <div class="payment-id">

                                    {{ $payment['id'] }}

                                </div>

                                <div class="small-text">

                                    {{ $payment['email'] ?? '-' }}

                                </div>

                            </td>

                            <td>

                                <div class="amount">

                                    ₹{{ number_format($payment['amount'] / 100, 2) }}

                                </div>

                            </td>

                            <td>

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

                            </td>

                            <td>

                                {{ strtoupper($payment['method'] ?? '-') }}

                            </td>

                            <td>

                                @if (($payment['amount_refunded'] ?? 0) > 0)
                                    <span class="badge refunded">

                                        ₹{{ number_format($payment['amount_refunded'] / 100, 2) }}

                                    </span>
                                @else
                                    -
                                @endif

                            </td>

                            <td>

                                {{ date('d M Y', $payment['created_at']) }}

                                <div class="small-text">

                                    {{ date('h:i A', $payment['created_at']) }}

                                </div>

                            </td>

                            <td>

                                <a href="{{ route('payments.show', $payment['id']) }}"
                                    class="view-btn">
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="empty-state">

                                    <h3>
                                        No Payments Found
                                    </h3>

                                    <p>
                                        Create your first payment
                                        to get started.
                                    </p>

                                </div>

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>
