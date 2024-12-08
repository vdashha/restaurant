@extends('welcome')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Список заказов</h1>

        @if($orders->count() === 0)
            <div class="alert alert-warning" role="alert">
                Заказы отсутствуют.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th>Дата заказа</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d.m.Y') }}</td>
                        <td>{{ number_format($order->total_price, 2, ',', ' ') }} ₽</td>
                        <td>
                            @if($order->status->isCompleted())
                                <span class="badge bg-success">{{ $order->status->label() }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $order->status->label() }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">Просмотр</a>
                            <form action="{{ route('orders.remove', $order->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Отменить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
