<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$customData['subject']}}</title>
</head>

<body>
    <div class="main-section">
        <!-- <div class="header-section" style="background: #f1f1f1;">
            <img src="{{ asset_url('img/logo.png') }}" class="logo" style="width: 10vw;" alt="Logo">
        </div> -->
        <div class="content-section">
            {!! $customData['msg'] !!}
        </div>
        <div class="footer-section"></div>
    </div>
</body>

</html>