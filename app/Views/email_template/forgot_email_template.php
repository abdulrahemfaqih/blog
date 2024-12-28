<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4A90E2;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reset Your Password</h2>
        </div>

        <p>Hello <?= $mailData['user']->name ?>,</p>

        <p>We received a request to reset your password. If you didn't make this request, you can ignore this email.</p>

        <p>To reset your password, click the button below:</p>

        <center>
            <a target="_blank" href="<?= $mailData['actionLink'] ?>" class="button">Reset Password</a>
        </center>

        <p>Or copy and paste this link in your browser:</p>
        <p style="word-break: break-all;"><?= $mailData['actionLink'] ?></p>

        <p>This link will expire in 15 Minutes for security reasons.</p>

        <div class="footer">
            <p>If you have any questions, please don't hesitate to contact us.</p>
            <p>&copy; <?= date('Y') ?> Blog CI4. All rights reserved.</p>
        </div>
    </div>
</body>
</html>