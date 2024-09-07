<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #ffd700;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px;
        }
        .content h1 {
            color: #333;
            font-size: 24px;
        }
        .content p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .content p strong {
            font-weight: bold;
        }
        .footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .footer a {
            color: #ffd700;
            text-decoration: none;
            font-weight: bold;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .footer p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header with Logo -->
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="Zinel Gifts Logo">
        </div>

        <!-- Main Content -->
        <div class="content">
            <h1>New Contact Form Message</h1>
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Message:</strong> {{ $userMessage }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for reaching out to us!</p>
            <p>For more information, visit our website: <a href="https://www.zinelgifts.com">www.zinelgifts.com</a></p>
            <p>&copy; {{ date('Y') }} Zinel Gifts. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
