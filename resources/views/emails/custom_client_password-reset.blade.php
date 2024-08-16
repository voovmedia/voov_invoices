<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            background-color: #ffffff;
            color: #333333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 50px;
        }
        .content {
            text-align: center;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #3490dc;
            text-decoration: none;
            border-radius: 5px;
        }
        .button a {
            color: #ffffff !important;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Logo --}}
        <div class="header">
            <img src="{{ asset(getLogoUrl()) }}" alt="{{ getAppName() }}" width="200" height="50" style="max-width: 200%; height: auto;">
        </div>

        {{-- Greeting --}}
        <div class="content">
            <h1>Hello! {{$name}}</h1>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            
            {{-- Button --}}
            <a href="{{ $resetUrl }}" class="button">Reset Password</a>

            <p style="margin-top: 20px;">This password reset link will expire in 60 minutes.</p>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>If you did not request a password reset, no further action is required.</p>
            <p>Thanks,<br>{{ getAppName() }}</p>
        </div>
    </div>
</body>
</html>
