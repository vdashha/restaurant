@extends('welcome')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Корзина</h1>

        @if ($cart->items->isEmpty())
            <div class="alert alert-info text-center">
                Ваша корзина пуста. <a href="{{ route('categories') }}" class="btn btn-primary btn-sm">Перейти к
                    меню</a>
            </div>
        @else
            <div class="cart-container">
                <div class="cart-items">
                    @foreach ($cart->items as $item)
                        <div class="cart-item d-flex align-items-center mb-3">
                            <div class="item-image me-3">
                                <img src="{{ asset($item->dish->image->getUrl()) }}" alt="{{ $item->dish->title }}"
                                     class="img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            <div class="item-details flex-grow-1">
                                <h5 class="item-title">{{ $item->dish->title }}</h5>
                                <p class="item-price">Цена: {{ number_format($item->dish->price, 2) }} ₽</p>
                            </div>
                            <div class="item-quantity me-3">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="number" name="quantity" class="form-control quantity-input"
                                           value="{{ $item->quantity }}" min="1">
                                    <button type="submit" class="btn btn-sm btn-success mt-2">Обновить</button>
                                </form>
                            </div>
                            <div class="item-total me-3">
                                {{ number_format($item->dish->price * $item->quantity, 2) }} ₽
                            </div>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="cart-summary mt-4">
                    <h4 class="text-end">Итоговая
                        стоимость: {{ number_format($cart->items->sum(fn($item) => $item->dish->price * $item->quantity), 2) }}
                        ₽</h4>
                    <div class="text-end mt-3">
                        <a href="{{ route('orders.store') }}" class="btn btn-primary">Оформить заказ</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        .cart-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .cart-summary {
            font-size: 1.2rem;
        }
    </style>
@endsection
