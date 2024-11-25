@extends('welcome')

@section('content')

    <div class="container my-5">
        <h2 class="text-center">Наши блюда</h2>
        <div class="row justify-content-center">
            @foreach($dishes as $dish)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($dish->image->getUrl()) }}" class="card-img-top" alt="{{ $dish->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $dish->title }}</h5>
                            <p class="card-text">{{ $dish->description }}</p> <!-- Добавлено описание блюда -->
                            <div class="mt-auto">
                                <a href="{{ route('dish.show', $dish->id) }}" class="btn btn-primary">Подробнее</a> <!-- Ссылка на подробности блюда -->
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
