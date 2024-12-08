@extends('welcome')

@section('content')
    <div class="container my-5">
        <h2 class="text-center">{{ $title }}</h2>
        <div class="row justify-content-center">
            @foreach($dishes as $dish)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($dish->image->getUrl()) }}" class="card-img-top" alt="{{ $dish->title }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $dish->title }}</h5>
                            <p class="card-text">{{ $dish->description }} / {{ $dish->weight }}</p>
                            <p class="card-text"><strong>Цена: {{ number_format($dish->price, 2) }} ₽</strong></p>
                            <a href="{{ route('cart.add', $dish->id ) }}" class="btn btn-light btn-lg">В корзину</a>
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
            overflow: hidden; /* Скрывает лишние части, если необходимо */
        }
    </style>
@endsection
