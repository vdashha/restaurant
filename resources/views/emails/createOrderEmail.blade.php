<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ создан</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffeef2;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffe0e8;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #ff85a2;
        }
        .header h1 {
            font-size: 24px;
            color: #ff5370;
            margin: 0 0 10px;
            text-align: center;
        }
        .content p {
            margin: 10px 0;
            padding: 10px;
            background-color: #ffe0e8;
            border-radius: 5px;
            text-align: center;
            color: #5a5a5a;
        }
        .content strong {
            color: #ff5370;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .footer a {
            color: #ff85a2;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Заказ создан!</h1>
    </div>
    <div class="content">
        <p>Здравствуйте, <strong>{{ $order->name }}</strong>!</p>
        <p>Ваш заказ с номером <strong>#{{ $order->id }}</strong> успешно создан.</p>
        <p>Вы можете забрать его по адресу: <strong>{{ $order->restaurant->address }}</strong>.</p>
    </div>
    <div class="footer">
        <p>С уважением,<br>Команда ресторана</p>
        <p><a href="{{ url('/') }}">Перейти на сайт</a> для получения дополнительной информации.</p>
    </div>
</div>
</body>
</html>
