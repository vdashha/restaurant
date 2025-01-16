@extends('welcome')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4" style="font-family: 'Roboto', sans-serif; font-size: 36px; color: #2c3e50;">{{__('order.orderTitle')}}</h1>

        <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <!-- Поле для ввода имени -->
            <div class="mb-3">
                <label for="name" class="form-label">{{__('order.name')}}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('order.placeholderName')}}" required>
            </div>

            <!-- Поле для ввода номера телефона -->
            <div class="mb-3">
                <label for="phone" class="form-label">{{__('order.phone')}}</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="{{__('order.placeholderPhone')}}"
                       pattern="\+375 \(\d{2}\) \d{3}-\d{2}-\d{2}" required>
            </div>

            <!-- Выбор доставки или самовывоза -->
            <div class="mb-3">
                <label class="form-label">{{__('order.selectDeliveryType')}}</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="delivery_method" id="pickup" value="pickup" checked>
                    <label class="form-check-label" for="pickup">
                        {{__('order.pickup')}}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="delivery_method" id="delivery" value="delivery">
                    <label class="form-check-label" for="delivery">
                        {{__('order.delivery')}}
                    </label>
                </div>
            </div>

            <!-- Поле для выбора ресторана -->
            <div class="mb-3" id="restaurant-field">
                <label for="restaurant" class="form-label">{{__('order.selectRestaurant')}}</label>
                <select class="form-select" id="restaurant" name="restaurant">
                    <option value="" selected disabled>{{__('order.selectRest')}}</option>
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->address }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Поле для ввода адреса доставки -->
            <div class="mb-3 d-none" id="delivery-address-field">
                <label for="delivery_address" class="form-label">{{__('order.deliveryAddress')}}</label>
                <input type="text" class="form-control" id="delivery_address" name="delivery_address" placeholder="{{__('order.placeholderDeliveryAddress')}}">
            </div>

            <!-- Поле для выбора времени готовности -->
            <div class="mb-3">
                <label for="ready_time" class="form-label">{{__('order.readyTime')}}</label>
                <input type="time" class="form-control" id="ready_time" name="ready_time" required>
            </div>

            <!-- Поле для выбора оплаты -->
            <div class="mb-3">
                <label class="form-label">{{__('order.paymentMethod')}}</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="card">
                    <label class="form-check-label" for="payment_card">
                        {{__('order.paymentCard')}}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="payment_cash" value="cash" checked>
                    <label class="form-check-label" for="payment_cash">
                        {{__('order.paymentCash')}}
                    </label>
                </div>
            </div>

            <!-- Поле для ввода комментария -->
            <div class="mb-3">
                <label for="comment" class="form-label">{{__('order.comment')}}</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="{{__('order.placeholderComment')}}"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100" style="font-size: 18px; background-color: #f39c12; border-color: #f39c12;">{{__('order.submitOrder')}}</button>
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
            const deliveryMethodInputs = document.querySelectorAll('input[name="delivery_method"]');
            const restaurantField = document.getElementById('restaurant-field');
            const deliveryAddressField = document.getElementById('delivery-address-field');
            const readyTimeInput = document.getElementById('ready_time');

            function updateFields() {
                const selectedMethod = document.querySelector('input[name="delivery_method"]:checked').value;

                if (selectedMethod === 'pickup') {
                    restaurantField.classList.remove('d-none');
                    deliveryAddressField.classList.add('d-none');

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
                } else {
                    restaurantField.classList.add('d-none');
                    deliveryAddressField.classList.remove('d-none');

                    // Увеличиваем время готовности на 20 минут для доставки
                    const now = new Date();
                    // Прибавляем 30 минут
                    now.setMinutes(now.getMinutes() + 60);
                    // Форматируем время для установки в поле (часы и минуты)
                    const formattedTime = now.toLocaleTimeString('en-GB', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    // Устанавливаем значение по умолчанию
                    readyTimeInput.value = formattedTime;
                }
            }

            deliveryMethodInputs.forEach(input => {
                input.addEventListener('change', updateFields);
            });

            // Установка значений по умолчанию
            updateFields();
        });
    </script>
@endsection

@section('styles')
    <style>
        .container {
            padding: 40px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

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

        .d-none {
            display: none;
        }
    </style>
@endsection
