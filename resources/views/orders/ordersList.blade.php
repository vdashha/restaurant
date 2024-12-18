@extends('welcome')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Список заказов</h1>

        @if($orders->count() === 0)
            <div class="alert alert-warning" role="alert">
                Заказы отсутствуют.
            </div>
        @else
            <table class="table table-striped" style="background-color: #fff; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden;">
                <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th>Дата заказа</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                    <th>Действия</th> <!-- Добавьте класс text-center здесь -->
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d.m.Y') }}</td>
                        <td>{{ number_format($order->total_price, 2, ',', ' ') }} ₽</td>
                        <td>
                            @if($order->status->isNew())
                                <span class="badge bg-info">{{ $order->status->getLabel() }}</span>
                            @elseif($order->status->isProcess())
                                <span class="badge bg-primary">{{ $order->status->getLabel() }}</span>
                            @elseif($order->status->isCompleted())
                                <span class="badge bg-success">{{ $order->status->getLabel() }}</span>
                            @elseif($order->status->isPendingDelivery())
                                <span class="badge bg-warning">{{ $order->status->getLabel() }}</span>
                            @elseif($order->status->isProcessDelivery())
                                <span class="badge bg-warning">{{ $order->status->getLabel() }}</span>
                            @elseif($order->status->isFailed())
                                <span class="badge bg-danger">{{ $order->status->getLabel() }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $order->status->getLabel() }}</span>
                            @endif
                        </td>
                        <td> <!-- Добавьте класс text-center здесь -->
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">Просмотр</a>
                            @if (!$order->status->isCompleted() && !$order->status->isFailed())
                                <form action="{{ route('orders.remove', $order->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Отменить</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
