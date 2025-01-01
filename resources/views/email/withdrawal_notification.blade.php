<!DOCTYPE html>
<html>

<head>
    <title>Payment Withdrawal Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-header img {
            max-width: 150px;
        }

        .email-content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-content">
            <p>Hi {{ $publishername }},</p>
            <p>We have received your payment withdrawal request for <strong>${{ $walletBalance }}</strong>.</p>
            <p>You will receive the payment in your respective PayPal account on the 15th and 28th of every month.</p>
            <p>If you have any questions or concerns, feel free to contact us!</p>
            <p>Thanks,</p>
            <p>The Link Publishers Team</p>
        </div>
        <div class="email-footer">
            <p>© {{ date('Y') }} Links Farmer. All