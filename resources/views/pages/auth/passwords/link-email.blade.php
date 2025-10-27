<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Reset Password</h1>
        </div>
        <div class="content">
            <p>Silakan reset password Anda dengan mengklik tombol di bawah ini. Jika Anda tidak meminta reset password, abaikan email ini.</p>
            <a href="{{ route('password.reset', $token) }}" class="reset-btn">Reset Password</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
