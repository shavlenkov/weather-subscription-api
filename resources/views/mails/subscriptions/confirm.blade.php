<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        margin: 0;
        padding: 0;
    }

    .email {
        max-width: 600px;
        margin: 30px auto;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .email__header {
        font-size: 24px;
        font-weight: bold;
        color: #333333;
        margin-bottom: 20px;
    }

    .email__body {
        font-size: 16px;
        color: #555555;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .email__footer {
        margin-top: 40px;
        font-size: 14px;
        color: #999999;
    }

    .confirm-btn {
        display: inline-block;
        background-color: #1d72b8;
        color: #ffffff;
        padding: 12px 24px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
    }
</style>
<body>
    <div class="email">
        <div class="email__header">Confirm Your Subscription</div>
        <div class="email__body">
            <p>Hi there!</p>
            <p>Thank you for subscribing to our weather newsletter for <strong>{{ $subscription->city }}</strong>.
                We're excited to have you on board.</p>
            <p>To start receiving updates from us, please confirm your subscription by clicking the button below:</p>
            <p>
                <a href="{{ route('confirm', ['token' => $subscription->token]) }}" class="confirm-btn">
                    Confirm Subscription
                </a>
            </p>
            <p>If you did not subscribe, please ignore this email.</p>
        </div>
        <div class="email__footer">
            Thanks,<br />
            {{ config('app.name') }}
        </div>
    </div>
</body>
