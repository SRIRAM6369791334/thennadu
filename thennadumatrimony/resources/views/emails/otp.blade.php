<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration OTP - Thennadu Matrimony</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f9f9f9;
            padding: 40px 0;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .email-header {
            background-color: #900C3F;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            color: #D4AF37;
            margin: 0;
            font-size: 24px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .email-body {
            padding: 40px;
            text-align: center;
        }
        .welcome-text {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }
        .otp-title {
            font-size: 14px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .otp-code {
            font-size: 48px;
            font-weight: 800;
            color: #900C3F;
            letter-spacing: 10px;
            margin: 20px 0;
            padding: 20px;
            background: #fff8f9;
            border-radius: 12px;
            border: 2px dashed #eec;
            display: inline-block;
        }
        .instructions {
            font-size: 15px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 30px;
        }
        .security-notice {
            font-size: 13px;
            color: #999;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
            margin-top: 20px;
        }
        .email-footer {
            background-color: #fafafa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="email-header">
                <h1>Thennadu Matrimony</h1>
            </div>
            <div class="email-body">
                <div class="welcome-text">Experience a Heavenly Match</div>
                <p class="instructions">Thank you for choosing Thennadu Matrimony. Use the following Verification Code (OTP) to complete your registration process.</p>
                
                <div class="otp-title">Your Verification Code</div>
                <div class="otp-code">{{ $otp }}</div>
                
                <p class="instructions">This code is valid for 10 minutes. Please do not share this OTP with anyone for security reasons.</p>
                
                <div class="security-notice">
                    If you didn't request this email, you can safely ignore it. Your account security is our priority.
                </div>
            </div>
            <div class="email-footer">
                &copy; {{ date('Y') }} Thennadu Matrimony. All Rights Reserved. <br>
                Tamil Nadu, India.
            </div>
        </div>
    </div>
</body>
</html>
