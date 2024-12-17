@extends('welcome')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4" style="font-family: 'Roboto', sans-serif; font-size: 36px; color: #2c3e50;">Оформление заказа</h1>

        <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <!-- Поле для ввода имени -->
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Введите ваше имя" required>
            </div>

            <!-- Поле для ввода номера телефона -->
            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="+375 (__) ___-__-__"
                       pattern="\+375 \(\d{2}\) \d{3}-\d{2}-\d{2}" required>
            </div>

            <!-- Поле для выбора времени готовности -->
            <div class="mb-3">
                <label for="ready_time" class="form-label">Время, к которому заказ будет готов</label>
                <input type="time" class="form-control" id="ready_time" name="ready_time" required>
            </div>

            <!-- Поле для выбора ресторана -->
            <div class="mb-3">
                <label for="restaurant" class="form-label">Выберите ресторан для получения</label>
                <select class="form-select" id="restaurant" name="restaurant" required>
                    <option value="" selected disabled>Выберите ресторан</option>
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->address }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Поле для выбора оплаты -->
            <div class="mb-3">
                <label class="form-label">Метод оплаты</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="card">
                    <label class="form-check-label" for="payment_card">
                        Оплата картой
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="payment_cash" value="cash"
                           checked>
                    <label class="form-check-label" for="payment_cash">
                        Оплата наличными
                    </label>
                </div>
            </div>

            <!-- Поле для ввода комментария -->
            <div class="mb-3">
                <label for="comment" class="form-label">Комментарий к заказу</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"
                          placeholder="Введите ваш комментарий (необязательно)"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100" style="font-size: 18px; background-color: #f39c12; border-color: #f39c12;">Оформить заказ</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function (e) {
                let value = phoneInput.value.replace(/\D/g, ''); // Убираем все символы, кроме цифр
                if (value.length > 3 && value.length <= 5) {
                    value = '+375 (' + value.slice(3);
                } else if (value.length > 5 && value.length <= 8) {
                    value = '+375 (' + value.slice(3, 5) + ') ' + value.slice(5);
                } else if (value.length > 8 && value.length <= 10) {
                    value = '+375 (' + value.slice(3, 5) + ') ' + value.slice(5, 8) + '-' + value.slice(8);
                } else if (value.length > 10) {
                    value = '+375 (' + value.slice(3, 5) + ') ' + value.slice(5, 8) + '-' + value.slice(8, 10) + '-' + value.slice(10, 12);
                }
                phoneInput.value = value;
            });

            const readyTimeInput = document.getElementById('ready_time');

            // Получаем текущее время
            const now = new Date();

            // Прибавляем 30 минут
            now.setMinutes(now.getMinutes() + 30);

            // Форматируем время для установки в поле (часы и минуты)
            const formattedTime = now.toLocaleTimeString('en-GB', {
                hour: '2-digit',
                minute: '2-digit'
            });

            // Устанавливаем значение по умолчанию
            readyTimeInput.value = formattedTime;

            // Устанавливаем минимальное значение
            readyTimeInput.setAttribute('min', formattedTime);

            // Устанавливаем максимальное значение (например, 21:40)
            const maxTime = "21:40";
            readyTimeInput.setAttribute('max', maxTime);
        });
    </script>
@endsection

@section('styles')
    <style>
        /* Общее оформление формы */
        .container {
            padding: 40px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Оформление заголовка */
        h1 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        /* Оформление кнопки */
        .btn-primary {
            background-color: #f39c12;
            border-color: #f39c12;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e67e22;
            border-color: #e67e22;
            transform: scale(1.05);
        }

        /* Оформление полей формы */
        .form-label {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }

        .form-select {
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 16px;
        }

        .form-check-label {
            font-size: 16px;
        }

        .form-check-input {
            margin-right: 10px;
        }
    </style>
@endsection
