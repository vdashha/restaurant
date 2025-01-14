@extends('welcome')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">{{__('order.order_list')}}</h1>

        @if($orders->count() === 0)
            <div class="alert alert-warning" role="alert">
                {{__('order.no_orders')}}
            </div>
        @else
            <table class="table table-striped"
                   style="background-color: #fff; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow: hidden;">
                <thead>
                <tr>
                    <th>{{__('order.order_number')}}</th>
                    <th>{{__('order.order_date')}}</th>
                    <th>{{__('order.total')}}</th>
                    <th>{{__('order.status')}}</th>
                    <th>{{__('order.actions')}}</th> <!-- Добавьте класс text-center здесь -->
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d.m.Y') }}</td>
                        <td>{{ number_format($order->total_price, 2, ',', ' ') }} Br</td>
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
                            <a href="{{ route('orders.show', $order->id) }}"
                               class="btn btn-sm btn-primary">{{__('order.view')}}</a>
                            @if (!$order->status->isCompleted() && !$order->status->isFailed())
                                <form action="{{ route('orders.remove', $order->id) }}" method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm({{__('order.confirm_cancel')}})">{{__('order.cancel')}}</button>
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
