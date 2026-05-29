<!DOCTYPE html>
<html>

<head>
    <title>Razorpay Test</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial;
            padding: 50px;
        }

        button {
            padding: 14px 25px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <h2>Razorpay Test Checkout</h2>

    <button id="pay-btn">
        Pay ₹500
    </button>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        const payBtn = document.getElementById('pay-btn');

        payBtn.onclick = async () => {

            payBtn.disabled = true;

            try {

                const orderResponse = await fetch(
                    "{{ route('razorpay.order') }}", {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),

                            'Content-Type': 'application/json'
                        }
                    }
                );

                // const order = await orderResponse.json();

                const options = {

                    key: "{{ config('services.razorpay.key') }}",

                    // amount: order.amount,
                    amount: 50000, // 500.00 INR in paise

                    // currency: order.currency,
                    currency: "INR",

                    name: "Test Company",

                    description: "Laravel Razorpay Test",

                    // order_id: order.id,

                    prefill: {
                        name: "Yuvi",
                        email: "test@example.com",
                        contact: "9999999999"
                    },

                    theme: {
                        color: "#3399cc"
                    },

                    handler: async function(response) {

                        const verifyResponse = await fetch(
                            "{{ route('razorpay.verify') }}", {
                                method: 'POST',

                                headers: {
                                    'X-CSRF-TOKEN': document
                                        .querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),

                                    'Content-Type': 'application/json'
                                },

                                body: JSON.stringify(response)
                            }
                        );

                        // const result = await verifyResponse.json();

                        if (result.success) {

                            alert('Payment Success');

                            console.log(result);

                        } else {

                            alert('Verification Failed');
                        }
                    },

                    modal: {
                        ondismiss: function() {

                            alert('Payment popup closed');

                            payBtn.disabled = false;
                        }
                    }
                };

                const razorpay = new Razorpay(options);

                razorpay.open();

            } catch (error) {

                console.error(error);

                alert('Something went wrong');

                payBtn.disabled = false;
            }
        };
    </script>

</body>

</html>
