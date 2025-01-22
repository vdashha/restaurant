@extends('welcome')
@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #333;">
            {{ __('cart.cart') }}
        </h1>

        @if ($cart->items->isEmpty())
            <div class="alert alert-info text-center">
                {{ __('cart.emptyCart') }}
                <a href="{{ route('categories') }}" class="btn btn-primary btn-sm">{{ __('cart.goToMenu') }}</a>
            </div>
        @else
            <div class="cart-container">
                <div class="cart-items">
                    @foreach ($cart->items as $item)
                        <div class="cart-item d-flex align-items-center mb-4 p-4 shadow-sm rounded" style="background-color: #fff; color: #333;">
                            <div class="item-image me-3">
                                <img src="{{ asset($item->dish->image?->getUrl()) }}" alt="{{ $item->dish->title }}"
                                     class="img-fluid" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                            </div>
                            <div class="item-details flex-grow-1">
                                <h5 class="item-title" style="font-size: 1.2rem; font-weight: 600; color: #333;">
                                    {{ __('cart.itemTitle', ['title' => $item->dish->title]) }}
                                </h5>
                                <p class="item-price" style="color: #777; font-size: 1rem;">
                                    {{ __('cart.itemPrice', ['price' => number_format($item->dish->price, 2)]) }}
                                </p>
                            </div>
                            <div class="item-quantity me-3">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="number" name="quantity" class="form-control quantity-input"
                                           value="{{ $item->quantity }}" min="1" style="max-width: 80px;">
                                    <button type="submit" class="btn btn-sm btn-success mt-2 w-100">{{ __('cart.update') }}</button>
                                </form>
                            </div>
                            <div class="item-total me-3" style="font-weight: bold; color: #333;">
                                {{ __('cart.itemTotal', ['total' => number_format($item->dish->price * $item->quantity, 2)]) }}
                            </div>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-danger mt-2">{{ __('cart.delete') }}</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="cart-summary mt-4">
                    <h4 class="text-end" style="font-size: 1.6rem; font-weight: bold; color: #333;">
                        {{ __('cart.totalCost') }}:
                        <strong>{{ number_format($cart->items->sum(fn($item) => $item->dish->price * $item->quantity), 2) }} BYN</strong>
                    </h4>
                    <div class="text-end mt-3">
                        <form action="{{ route('orders.placingOrder') }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg" style="font-size: 1.1rem;">
                                {{ __('cart.placeOrder') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


@section('styles')
    <style>
        /* Контейнер корзины */
        .cart-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Элемент корзины */
        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .cart-item:hover {
            background-color: #f1f1f1;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Сводка корзины */
        .cart-summary {
            font-size: 1.2rem;
            font-family: 'Poppins', sans-serif;
        }

        .item-details h5 {
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin-bottom: 10px;
        }

        .item-price {
            color: #555;
        }

        .quantity-input {
            width: 70px;
            padding: 5px;
            font-size: 1rem;
        }

        .cart-item .btn {
            margin-top: 5px;
        }

        .alert {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #f44336;
            border-color: #f44336;
            padding: 8px 16px;
            font-size: 1rem;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }
    </style>
@endsection
