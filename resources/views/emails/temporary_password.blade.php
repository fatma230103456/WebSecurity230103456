<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} - Temporary Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .password-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h2>Your Temporary Password</h2>

    <p>Hello,</p>

    <p>You have requested a temporary password. Here is your temporary password:</p>

    <div class="password-box">
        <strong>{{ $tempPassword }}</strong>
    </div>

    <p>For security reasons, you will be required to change this password when you log in.</p>

    <p>If you didn't request this temporary password, please contact us immediately.</p>

    <p>
        Best regards,<br>
        {{ config('app.name') }}
    </p>
</body>
</html> 