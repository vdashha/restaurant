@extends('welcome')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Ваш заказ</h1>

        <div class="order-details">
            <p><strong>Номер заказа:</strong> {{ $order->id }}</p>
            <p><strong>Дата:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Статус:</strong> {{ $order->status->label() }}</p>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Блюдо</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Итог</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->dish->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }} ₽</td>
                    <td>{{ number_format($item->price * $item->quantity, 2) }} ₽</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h4 class="text-end mt-4">Общая стоимость: {{ number_format($order->total_price, 2) }} ₽</h4>
    </div>
@endsection
