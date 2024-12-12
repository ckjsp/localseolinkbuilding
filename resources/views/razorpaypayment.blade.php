<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>

<body>
    <form id="razorpay-form" action="{{ route('razorpay.create') }}" method="POST">
        @csrf
        <input type="hidden" name="price" value="{{ $price }}">
        <input type="hidden" name="orderId" value="{{ $orderId }}">
    </form>

    <script>
        document.getElementById('razorpay-form').submit();
    </script>
</body>

</html>