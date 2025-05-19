<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f0f4f8;
        color: #333;
        padding: 20px;
    }

    .report {
        max-width: 400px;
        margin: auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 30px;
        word-wrap: break-word;
    }

    h2 {
        text-align: center;
        color: #007BFF;
    }

    .report__info {
        margin-top: 20px;
        font-size: 18px;
    }

    .report__info span {
        display: block;
        margin-bottom: 12px;
        line-height: 1.5;
    }

    .report__label {
        font-weight: bold;
        color: #555;
    }

    .unsubscribe-btn {
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 30px;
        padding: 12px 0;
        background-color: #dc3545;
        color: #fff !important;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .unsubscribe-btn:hover {
        background-color: #c82333;
    }
</style>

<body>
<div class="report">
    <h2>City: {{ $city }}</h2>
    <div class="report__info">
        <span><span class="report__label">Temperature:</span> {{ $data['temperature'] }} &deg;C</span>
        <span><span class="report__label">Humidity:</span> {{ $data['humidity'] }} %</span>
        <span><span class="report__label">Description:</span> {{ $data['description'] }}</span>
    </div>
    <a href="{{ route('unsubscribe', ['token' => $token]) }}" class="unsubscribe-btn">Unsubscribe</a>
</div>
</body>
