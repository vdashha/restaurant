@extends('welcome')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; font-size: 36px; color: #2c3e50;">Ваш заказ</h1>

        <!-- Детали заказа -->
        <div class="order-details mb-4">
            <p><strong>Номер заказа:</strong> <span class="text-muted">{{ $order->id }}</span></p>
            <p><strong>Дата:</strong> <span class="text-muted">{{ $order->created_at->format('d.m.Y H:i') }}</span></p>
            <p><strong>Статус:</strong> <span class="badge bg-info">{{ $order->status->getLabel() }}</span></p>
            <p><strong>Адрес:</strong> <span class="text-muted">{{ $order->restaurant->address }}</span></p>
        </div>

        <!-- Таблица с деталями блюд -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-lg rounded" style="background-color: #fafafa;">
                <thead class="thead-light">
                <tr style="background-color: #f1f1f1;">
                    <th>Блюдо</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Итог</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order->items as $item)
                    <tr style="background-color: #ffffff;">
                        <td>{{ $item->dish->title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }} BYN</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }} BYN</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Общая стоимость -->
        <div class="d-flex justify-content-between mt-4">
            <h4 class="text-end" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.5rem; color: #333;">
                Общая стоимость: <strong>{{ number_format($order->total_price, 2) }} BYN</strong>
            </h4>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Стили для деталей заказа */
        .order-details p {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            color: #555;
        }

        /* Стили для таблицы */
        .table {
            border-radius: 10px;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        .table th {
            background-color: #f1f1f1;
            text-align: center;
            font-weight: 600;
            color: #333;
            padding: 15px;
        }

        .table td {
            text-align: center;
            padding: 12px;
            color: #555;
        }

        .table-hover tbody tr:hover {
            background-color: #e6f7ff;
            transform: translateY(-5px);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        /* Стили для общей стоимости */
        .d-flex {
            font-family: 'Poppins', sans-serif;
            font-size: 1.25rem;
        }

        /* Заголовок */
        h1 {
            font-weight: 600;
            color: #333;
        }
    </style>
@endsection
