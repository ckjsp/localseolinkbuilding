<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>
    <form id="razorpay-form" action="{{ route('razorpay.callback') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        <input type="hidden" name="custom_order_id" value="{{ $custom_order_id }}">
    </form>

    <script>
        window.onload = function() {
            var options = {
                "key": "{{ $key }}",
                "amount": "{{ $amount }}",
                "currency": "{{ $currency }}",
                "order_id": "{{ $order_id }}",
                "receipt": "{{ $custom_order_id }}",
                "handler": function(response) {
                    console.log("Payment successful: ", response);

                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;

                    document.getElementById('razorpay-form').submit();
                },
                "prefill": {
                    "name": "{{ $userName ?? '' }}",
                    "email": "{{ $userEmail ?? '' }}",
                    "contact": "{{ $userContact ?? '' }}"
                },
                "theme": {
                    "color": "#F37254"
                },
                "cancel_url": "{{ route('razorpay.cancel', ['orderId' => $custom_order_id]) }}"
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
        };
    </script>

</body>

</html>