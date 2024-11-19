@extends('welcome')

@section('content')
    <header
        class="text-white text-center py-5"
        style="background-image: url('{{ asset('images/home/header.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 250px;">
        <h1>Добро пожаловать в наш ресторан!</h1>
        <p class="lead">Наслаждайтесь лучшими блюдами и атмосферой</p>
        <a href="{{ route('categories') }}" class="btn btn-light btn-lg">Посмотреть меню</a>
    </header>

    <div class="container my-5">
        <h2 class="text-center">Специальные предложения</h2>
        <div class="row justify-content-center">
            @foreach($promotions as $offer)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($offer->image) }}" class="card-img-top" alt="{{ $offer->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $offer->title }}</h5>
                            <p class="card-text">{{ $offer->description }}</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Срок действия: {{ \Carbon\Carbon::parse($offer->start_date)->format('d.m.Y') }} - {{ \Carbon\Carbon::parse($offer->end_date)->format('d.m.Y') }}
                                </small>
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('home') }}" class="btn btn-primary">Заказать</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="text-center mt-5">О нас</h2>
        <p class="text-center">Мы - ресторан, который предлагает вам лучшие блюда, приготовленные с любовью. Наша команда профессионалов всегда готова сделать ваше пребывание у нас незабываемым.</p>
    </div>
@endsection
