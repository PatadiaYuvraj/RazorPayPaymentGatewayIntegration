<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Create Payment
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px;
            min-height: 100vh;
            background:
                linear-gradient(135deg,
                    #0f172a,
                    #111827,
                    #1e293b);
            font-family: Arial, sans-serif;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wrapper {
            width: 100%;
            max-width: 650px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
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
            padding: 28px 30px;
            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);
        }

        .card-title {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .card-subtitle {
            color: #94a3b8;
            font-size: 14px;
        }

        .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 28px;
        }

        .label {
            display: block;
            margin-bottom: 12px;
            color: #cbd5e1;
            font-size: 14px;
            font-weight: bold;
        }

        .input {
            width: 100%;
            padding: 16px;
            border-radius: 14px;
            border:
                1px solid rgba(255, 255, 255, 0.08);
            background:
                rgba(255, 255, 255, 0.06);
            color: white;
            font-size: 16px;
            outline: none;
            transition: 0.2s;
        }

        .input:focus {
            border-color: #3b82f6;
            box-shadow:
                0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .input::placeholder {
            color: #94a3b8;
        }

        .gateway-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .gateway-option {
            position: relative;
        }

        .gateway-option input {
            position: absolute;
            opacity: 0;
        }

        .gateway-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px;
            border-radius: 16px;
            border:
                1px solid rgba(255, 255, 255, 0.08);
            background:
                rgba(255, 255, 255, 0.04);
            cursor: pointer;
            transition: 0.2s;
        }

        .gateway-card:hover {
            transform: translateY(-2px);
            background:
                rgba(255, 255, 255, 0.06);
        }

        .gateway-option input:checked+.gateway-card {

            border-color: #3b82f6;

            background:
                rgba(59, 130, 246, 0.12);

            box-shadow:
                0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .gateway-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .gateway-logo {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background:
                linear-gradient(135deg,
                    #2563eb,
                    #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
        }

        .gateway-name {
            font-size: 16px;
            font-weight: bold;
        }

        .gateway-desc {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 4px;
        }

        .selected-badge {
            background:
                rgba(34, 197, 94, 0.15);
            color: #4ade80;
            padding: 8px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: bold;
        }

        .submit-btn {
            width: 100%;
            border: none;
            padding: 18px;
            border-radius: 16px;
            background:
                linear-gradient(135deg,
                    #2563eb,
                    #3b82f6);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .secure-box {
            margin-top: 20px;
            padding: 18px;
            border-radius: 14px;
            background:
                rgba(255, 255, 255, 0.04);
            border:
                1px solid rgba(255, 255, 255, 0.06);
        }

        .secure-title {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .secure-text {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.6;
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

            .page-title {
                font-size: 28px;
            }

            .card-body {
                padding: 22px;
            }
        }
    </style>

</head>

<body>

    <div class="wrapper">

        <div class="top-bar">

            <div class="page-title">
                Create Payment
            </div>

            <a href="{{ route('payments.index') }}" class="back-btn">
                ← Back
            </a>

        </div>

        <div class="card">

            <div class="card-header">

                <div class="card-title">
                    Payment Checkout
                </div>

                <div class="card-subtitle">
                    Create and process a payment
                    securely using available gateways.
                </div>

            </div>

            <div class="card-body">

                <form id="payment-form">

                    <div class="form-group">

                        <label class="label">
                            Amount
                        </label>

                        <input type="number" name="amount" class="input" step="0.01" min="1"
                            placeholder="Enter amount" required>

                    </div>

                    <div class="form-group">

                        <label class="label">
                            Payment Method
                        </label>

                        <div class="gateway-grid">

                            @foreach ($paymentMethods as $key => $value)
                                <label class="gateway-option">

                                    <input type="radio" name="gateway" value="{{ $key }}"
                                        {{ $loop->first ? 'checked' : '' }}>

                                    <div class="gateway-card">

                                        <div class="gateway-info">

                                            <div class="gateway-logo">
                                                ₹
                                            </div>

                                            <div>

                                                <div class="gateway-name">
                                                    {{ $value }}
                                                </div>

                                                <div class="gateway-desc">
                                                    UPI, Cards,
                                                    Net Banking,
                                                    Wallets
                                                </div>

                                            </div>

                                        </div>

                                        <div class="selected-badge">
                                            ACTIVE
                                        </div>

                                    </div>

                                </label>
                            @endforeach

                        </div>

                    </div>

                    <button type="submit" class="submit-btn" id="submit-btn">
                        Proceed To Checkout
                    </button>

                </form>

                <div class="secure-box">

                    <div class="secure-title">
                        Secure Payment
                    </div>

                    <div class="secure-text">

                        Payments are processed
                        securely through Razorpay.
                        Supports UPI, cards,
                        net banking, wallets,
                        and more.

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            newestOnTop: true,
            positionClass: "toast-top-right",
            preventDuplicates: true,
            timeOut: "3000"
        };
        const form =
            document.getElementById(
                'payment-form'
            );

        const submitButton =
            document.getElementById(
                'submit-btn'
            );

        form.addEventListener(
            'submit',
            async function(e) {

                e.preventDefault();

                submitButton.disabled = true;

                submitButton.innerText =
                    'Creating Order...';

                try {

                    const formData =
                        new FormData(form);

                    const response =
                        await fetch(
                            "{{ route('payments.store') }}", {
                                method: 'POST',

                                headers: {
                                    'X-CSRF-TOKEN': document
                                        .querySelector(
                                            'meta[name="csrf-token"]'
                                        )
                                        .getAttribute(
                                            'content'
                                        )
                                },

                                body: formData
                            }
                        );

                    const result =
                        await response.json();

                    submitButton.disabled = false;

                    submitButton.innerText =
                        'Proceed To Checkout';

                    const options = {

                        key: result.key,

                        amount: result.order.amount,

                        currency: result.order.currency,

                        order_id: result.order.id,

                        name: 'Payment Integration',

                        description: 'Laravel Payment Checkout',

                        handler: async function(
                            response
                        ) {


                            try {

                                const verifyResponse =
                                    await fetch(
                                        "{{ route('payments.verify') }}", {
                                            method: 'POST',

                                            headers: {

                                                'Content-Type': 'application/json',

                                                'X-CSRF-TOKEN': document
                                                    .querySelector(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                    .getAttribute(
                                                        'content'
                                                    )
                                            },

                                            body: JSON.stringify({

                                                razorpay_payment_id: response.razorpay_payment_id,

                                                razorpay_order_id: response.razorpay_order_id,

                                                razorpay_signature: response.razorpay_signature
                                            })
                                        }
                                    );

                                const result =
                                    await verifyResponse.json();

                                if (result.success) {

                                    setTimeout(() => {

                                        window.location.href =
                                            "{{ route('payments.index') }}";

                                    }, 1500);

                                } else {

                                    toastr.error(
                                        result.message
                                    );
                                }

                            } catch (error) {

                                console.error(error);

                                toastr.error(
                                    'Payment verification failed'
                                );
                            }


                        }

                    };

                    const razorpay =
                        new Razorpay(options);

                    razorpay.open();

                } catch (error) {

                    submitButton.disabled = false;

                    submitButton.innerText =
                        'Proceed To Checkout';

                    alert(
                        'Something went wrong'
                    );

                    console.error(error);
                }
            }
        );
    </script>

</body>

</html>
