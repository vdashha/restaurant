@extends('welcome')

@section('content')
    <header class="bg-primary text-white text-center py-5">
        <h1>Добро пожаловать в наш ресторан!</h1>
        <p class="lead">Наслаждайтесь лучшими блюдами и атмосферой</p>
        <a href="{{ route('menu') }}" class="btn btn-light btn-lg">Посмотреть меню</a>
    </header>

    <div class="container my-5">
        <h2 class="text-center">Специальные предложения</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/special1.jpg') }}" class="card-img-top" alt="Специальное предложение 1">
                    <div class="card-body">
                        <h5 class="card-title">Сет из 3-х блюд</h5>
                        <p class="card-text">Попробуйте наш уникальный сет из трех блюд по специальной цене!</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Заказать</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/special2.jpg') }}" class="card-img-top" alt="Специальное предложение 2">
                    <div class="card-body">
                        <h5 class="card-title">Десерт дня</h5>
                        <p class="card-text">Каждый день у нас новый вкусный десерт по сниженной цене!</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Заказать</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/special3.jpg') }}" class="card-img-top" alt="Специальное предложение 3">
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
