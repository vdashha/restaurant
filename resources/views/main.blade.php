@extends('welcome')

@section('content')
    <header
        class="text-white text-center py-5"
        style="background-image: url('{{ asset('images/home/header.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 350px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
        <div>
            <h1 style="font-family: 'Poppins', sans-serif;">{{__('home.welcome')}}</h1>
            <p class="lead" style="font-family: 'Poppins', sans-serif;">{{__('home.atmosphere')}}</p>
            <a href="{{ route('categories') }}" class="btn btn-light btn-lg shadow-sm">{{__('home.menu')}}</a>
        </div>
    </header>

    <!-- Специальные предложения -->
    <div class="container my-5">
        <h2 class="text-center" style="font-family: 'Poppins', sans-serif; color: #333;">{{__('home.offers')}}</h2>
        <div class="row justify-content-center">
            @foreach($promotions as $offer)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-lg border-0 rounded-3">
                        <img src="{{ asset($offer->image?->getUrl()) }}" class="card-img-top" alt="{{ $offer->title }}"
                             style="height: 200px; object-fit: cover; border-radius: 10px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="font-family: 'Poppins', sans-serif;">{{ $offer->title }}</h5>
                            <p class="card-text" style="font-family: 'Poppins', sans-serif; color: #555;">{{ $offer->description }}</p>
                            <p class="card-text" style="font-family: 'Poppins', sans-serif;">
                                <small class="text-muted">
                                    {{__('home.validity_period')}} {{ \Carbon\Carbon::parse($offer->start_date)->format('d.m.Y') }} - {{ \Carbon\Carbon::parse($offer->end_date)->format('d.m.Y') }}
                                </small>
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('dishes', '31')}}" class="btn btn-primary shadow-sm">{{__('home.order')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- О нас с фоном на всю ширину -->
    <div class="container-fluid" style="background-color: #333; padding: 20px 0;">
        <div class="container">
            <h2 class="text-center" style="font-family: 'Poppins', sans-serif; color: #fff;">{{__('home.about')}}</h2>
            <p class="text-center" style="font-family: 'Poppins', sans-serif; color: #f0f0f0; line-height: 1.6;">{{__('home.about_text')}}</p>

            <ul class="list-unstyled text-center" style="font-family: 'Poppins', sans-serif; color: #f0f0f0;">
                @foreach($restaurants as $restaurant)
                    <li style="margin: 8px 0;">{{ $restaurant->address }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Подключим Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* Стили для кнопки */
        .btn-lg {
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* Для добавления шлейфа на кнопке */
        .btn-primary {
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Стили для контейнера "О нас" */
        .container-fluid {
            background-color: #333;
            color: #fff;
        }
    </style>
@endsection
