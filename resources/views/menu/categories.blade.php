@extends('welcome')

@section('content')
    <div class="container my-5">
        <h2 class="text-center" style="font-family: 'Poppins', sans-serif; color: #333;">{{ $title }}</h2>
        <div class="row justify-content-center">
            @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('subcategories', $category->id) }}" class="text-decoration-none">
                        <div class="card h-100 position-relative shadow-lg border-0 rounded-3 overflow-hidden">
                            <img src="{{ asset($category->image?->getUrl()) }}" class="card-img-top" alt="{{ $category->title }}"
                                 style="height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                            <div class="card-body text-center position-absolute bottom-0 start-50 translate-middle-x p-3">
                                <h5 class="card-title text-white" style="font-family: 'Poppins', sans-serif; font-weight: bold;">
                                    {{ $category->title }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Улучшение стилей для карточек */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* Стиль для карточки с изображением */
        .card-img-top {
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        /* Заголовки и текст */
        .card-body h5 {
            font-size: 24px;
            letter-spacing: 1px;
        }

        /* Подключим шрифт Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
    </style>
@endsection
