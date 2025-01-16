<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($customData['subject']); ?></title>
</head>

<body>
    <div class="main-section" style="width:40%;background-color:#1c8adb4a; margin:auto; text-align:center; box-shadow:0px 0px 35px #bfbfbf; margin:10vh auto;padding-bottom:30px;">
        <!-- <div class="header-section" style="background: #f1f1f1;">
            <img src="<?php echo e(asset_url('img/logo.png')); ?>" class="logo" style="width: 10vw;" alt="Logo">
        </div> -->
        <div class="content-section" style="width: 50%; margin: auto; text-align: start;">
            <?php echo $customData['msg']; ?>

        </div>
        <div class="footer-section"></div>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/mail.blade.php ENDPATH**/ ?>