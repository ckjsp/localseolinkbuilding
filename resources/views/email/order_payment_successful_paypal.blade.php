<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>

<body>
    <p>Your payment for Order ID: <strong>{{ $order_id }}</strong> has been successfully processed.</p>
    <p><strong>Order Details:</strong></p>
    <ul>
        <li><strong>Order ID:</strong> {{ $order_id }}</li>
        <li><strong>Payment Method:</strong> PayPal</li>
        <li><strong>Payment ID:</strong> {{ $payment_id }}</li>
    </ul>
    <p>Thank you for your payment. You can view your orders in your dashboard.</p>
</body>

</html>