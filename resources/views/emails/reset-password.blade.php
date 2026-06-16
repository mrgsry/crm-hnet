<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        background-color: #f4f7f9;
        margin: 0;
        padding: 0;
        line-height: 1.6;
        color: #334155;
    }

    .container {
        max-width: 600px;
        margin: 40px auto;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .header {
        background-color: #1e293b;
        padding: 30px;
        text-align: center;
    }

    .header img {
        max-height: 80px;
    }

    .content {
        padding: 40px;
    }

    .footer {
        background-color: #f8fafc;
        padding: 20px;
        text-align: center;
        font-size: 0.875rem;
        color: #64748b;
    }

    h1 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 24px;
        color: #0f172a;
    }

    p {
        margin-bottom: 16px;
    }

    .button-container {
        text-align: center;
        margin: 32px 0;
    }

    .button {
        background-color: #2563eb;
        color: #ffffff;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        transition: background-color 0.2s;
    }

    .button:hover {
        background-color: #1d4ed8;
    }

    .security-notice {
        font-size: 0.875rem;
        color: #94a3b8;
        margin-top: 32px;
        border-top: 1px solid #e2e8f0;
        padding-top: 24px;
    }

    .link-text {
        word-break: break-all;
        color: #2563eb;
        font-size: 0.8125rem;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('storage/img/hnetlogo.png') }}" alt="{{ config('app.name') }}">
        </div>
        <div class="content">
            <h1>Reset Your Password</h1>
            <p>Hello {{ $name }},</p>
            <p>You are receiving this email because we received a password reset request for your account.</p>

            <div class="button-container">
                <a href="{{ $url }}" class="button">Reset Password</a>
            </div>

            <p>This password reset link will expire in
                {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutes.</p>
            <p>If you did not request a password reset, no further action is required.</p>

            <div class="security-notice">
                <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your
                    web browser:</p>
                <p class="link-text">{{ $url }}</p>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>Customer Relationship Management Solution</p>
        </div>
    </div>
</body>

</html>