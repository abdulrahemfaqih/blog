<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Changed Notification</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
        <h2 style="color: #007bff;">Password Change Notification</h2>

        <p>Hello <?= $mailData['user']->name ?>,</p>

        <p>Your password has been successfully changed.</p>

        <p>Your new password is: <strong><?= $mailData['new_password'] ?></strong></p>

        <p>For security reasons, we recommend you to:</p>
        <ul>
            <li>Change this password after your first login</li>
            <li>Never share your password with anyone</li>
            <li>Use a strong password with a combination of letters, numbers, and special characters</li>
        </ul>

        <p>If you did not request this password change, please contact our support team immediately.</p>

        <p style="margin-top: 20px;">Best regards,<br>Blog CI4</p>
    </div>

    <div style="text-align: center; margin-top: 20px; font-size: 12px; color: #666;">
        <p>This is an automated message, please do not reply to this email.</p>
    </div>
</body>

</html>