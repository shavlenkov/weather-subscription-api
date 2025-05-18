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
    }
    h2 {
        text-align: center;
        color: #007BFF;
    }
    .info {
        margin-top: 20px;
        font-size: 18px;
    }
    .info span {
        display: block;
        margin-bottom: 10px;
    }
    .label {
        font-weight: bold;
        color: #555;
    }
    .unsubscribe-btn {
        display: inline-block;
        margin-top: 30px;
        padding: 12px 20px;
        background-color: #dc3545;
        color: #fff !important;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        text-align: center;
        transition: background-color 0.3s ease;
    }
    .unsubscribe-btn:hover {
        background-color: #c82333;
    }
</style>
<body>
<div class="report">
    <h2>City: {{ $city }}</h2>
    <div class="info">
        <span><span class="label">Temperature:</span> {{ $data['temperature'] }}°C</span>
        <span><span class="label">Humidity:</span> {{ $data['humidity'] }}</span>
        <span><span class="label">Description:</span> {{ $data['description'] }}</span>
    </div>
    <a href="{{ route('unsubscribe', ['token' => $token]) }}" class="unsubscribe-btn">Unsubscribe</a>
</div>
</body>
