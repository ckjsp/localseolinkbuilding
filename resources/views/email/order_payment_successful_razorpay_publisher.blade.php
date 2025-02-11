<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New orders have been successfully placed for your website</title>
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
        <h1>New orders have been successfully placed for your website</h1>

        <p>Dear Publisher,</p>
        <p>New orders have been successfully placed for your website! Here are the details of the recent order:</p>

        <p><strong>Order Details:</strong></p>
        <ul>
            <li>
                <strong>Website Name:</strong> {{ $websitename }}
            </li>

            <li><strong>Order ID:</strong> {{ $customOrderId }}</li>
            <li><strong>Type:</strong> {{ $attachment_type == 'provide_content' ? 'Blog Post' : 'Link Insertion' }}</li>
            <li><strong>Categories:</strong> {{ implode(', ', $categories) }}</li>


        </ul>

        <p><strong>Important Notes:</strong></p>
        <ul>
            <li>
                You can view and manage this order in your publisher <a href="{{ route('publisher') }}"> dashboard.</a>
            </li>
        </ul>

        <p>If you have any questions or need assistance, feel free to contact our support team (info@linksfarmer.com).</p>

        <div class="footer">
            <p>Thank you for partnering with us!</p>
            <p><strong>Links Farmer</strong><br>No Reply Email</p>
        </div>
    </div>

</body>

</html>