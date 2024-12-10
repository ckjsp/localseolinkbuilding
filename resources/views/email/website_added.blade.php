<html>

<body>
    <div style="font-family: Arial, sans-serif; line-height: 1.6;">
        <h2 style="color: #2c3e50;">Links Farmer - New Website Added</h2>
        <p>Hello</p>
        <p>A new website has been added and is awaiting approval:</p>
        <ul>
            <li><strong>Website URL:</strong> {{ $websiteUrl }}</li>
            <li><strong>Submitted by:</strong> {{ $userName }} ({{ Auth::user()->email }})</li>
        </ul>
        <p>Please review and approve the website in the admin panel.</p>
        <p>Thank you</p>
        <p>&copy; {{ date('Y') }} Links Farmer</p>
    </div>
</body>

</html>