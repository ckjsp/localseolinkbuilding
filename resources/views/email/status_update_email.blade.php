<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Update - Links Farmer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        li {
            padding: 5px 0;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>

    <h1>Website Status Update</h1>
    <p>Your website status has been updated:</p>
    <ul>
        <li><strong>Website:</strong> {{ $website_url }}</li>
        <li><strong>New Status:</strong> {{ $status }}</li>
        @if($rejectionMessage)
        <li><strong>Reason for Rejection:</strong> {{ $rejectionMessage }}</li>
        @endif
    </ul>

    <p>If you have any questions or concerns, please contact our customer support.</p>

    <p class="footer">Thank you for choosing our platform!</p>
</body>

</html>