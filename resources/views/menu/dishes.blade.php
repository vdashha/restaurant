@extends('welcome')

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-5" style="font-family: 'Roboto', sans-serif; font-size: 36px; color: #2c3e50;">{{ $title }}</h2>
        <div class="row justify-content-center">
            @foreach($dishes as $dish)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-lg rounded-3 overflow-hidden">
                        <img src="{{ asset($dish->image?->getUrl()) }}" class="card-img-top" alt="{{ $dish->title }}"
                             style="height: 300px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="font-size: 22px; font-weight: bold; color: #333;">{{ $dish->title }}</h5>
                            <p class="card-text" style="font-size: 14px; color: #555;">{{ $dish->description }} / {{ $dish->weight }}</p>
                            <p class="card-text" style="font-size: 16px; color: #f39c12;"><strong>{{__('dish.price')}}: {{ number_format($dish->price, 2) }} Br</strong></p>
                            <a href="{{ route('cart.add', $dish->id ) }}" class="btn btn-warning btn-lg w-100 mt-3" style="font-size: 16px;">{{__('dish.inCart')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .btn-warning {
            background-color: #f39c12;
            border-color: #f39c12;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e67e22;
            border-color: #e67e22;
            transform: scale(1.05);
        }

        /* Card body */
        .card-body {
            background-color: #fff;
            padding: 30px;
        }

        .card-title {
            font-family: 'Roboto', sans-serif;
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            font-size: 14px;
            color: #555;
        }

        /* Font for dish price */
        .card-text strong {
            font-size: 16px;
            color: #f39c12;
        }

        /* Hover effects for cards */
        .card:hover .card-body {
            background-color: #f8f8f8;
        }

        /* Global settings */
        .container {
            padding: 40px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        .container h2 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 40px;
        }
    </style>
@endsection
