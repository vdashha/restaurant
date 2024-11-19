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
        <a href="{{ route('menu') }}" class="btn btn-light btn-lg">Посмотреть меню</a>
    </header>

    <div class="container my-5">
        <h2 class="text-center">Специальные предложения</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/home/sets.jpg') }}" class="card-img-top" alt="Сет из 3-х блюд" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Сет из 3-х блюд</h5>
                        <p class="card-text">Попробуйте наш уникальный сет из трех блюд по специальной цене!</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Заказать</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/home/cakes.jpg') }}" class="card-img-top" alt="Десерт дня" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Десерт дня</h5>
                        <p class="card-text">Каждый день у нас новый вкусный десерт по сниженной цене!</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Заказать</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/home/drinks.jpg') }}" class="card-img-top" alt="Напитки со скидкой" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Напитки со скидкой</h5>
                        <p class="card-text">Скидка на все напитки в течение happy hour!</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Заказать</a>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center mt-5">О нас</h2>
        <p class="text-center">Мы - ресторан, который предлагает вам лучшие блюда, приготовленные с любовью. Наша команда профессионалов всегда готова сделать ваше пребывание у нас незабываемым.</p>
    </div>
@endsection
