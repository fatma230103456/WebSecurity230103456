<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} - Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .reset-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .reset-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Password Reset Request</h2>

    <p>Hello,</p>

    <p>We received a request to reset your password. Click the button below to reset it:</p>

    <div style="text-align: center;">
        <a href="{{ $resetLink }}" class="reset-button">Reset Password</a>
    </div>

    <p>This password reset link will expire in 24 hours.</p>

    <p>If you didn't request this password reset, you can safely ignore this email.</p>

    <p>
        Best regards,<br>
        {{ config('app.name') }}
    </p>
</body>
</html> 