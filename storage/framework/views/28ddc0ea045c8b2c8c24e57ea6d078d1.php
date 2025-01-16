<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>

<body>
    <form id="razorpay-form" action="<?php echo e(route('razorpay.create')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="price" value="<?php echo e($price); ?>">
        <input type="hidden" name="orderId" value="<?php echo e($orderId); ?>">
    </form>

    <script>
        document.getElementById('razorpay-form').submit();
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/razorpaypayment.blade.php ENDPATH**/ ?>