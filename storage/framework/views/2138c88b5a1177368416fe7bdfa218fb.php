<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($subject); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            padding: 5px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <h1><?php echo e($subject); ?></h1>

        <p>Your payment for Order ID: <strong><?php echo e($customOrderId); ?></strong> has been successfully processed.</p>
        <p><strong>Order Details:</strong></p>
        <ul>
            <li>Order ID: <?php echo e($customOrderId); ?></li>
            <li>Payment Method: Razorpay</li>
        </ul>
        <p>Thank you for your payment. You can view your orders in your dashboard.</p>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p><strong>Links Farmer</strong><br>No Reply Email</p>
        </div>
    </div>

</body>

</html><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/email/order_payment_successful_razorpay.blade.php ENDPATH**/ ?>