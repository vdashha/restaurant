@extends('welcome')

@section('content')
    <div class="container my-5">
        <h2 class="text-center">{{ $title }}</h2>
        <div class="row justify-content-center">
            @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('subcategories', $category->id) }}" class="text-decoration-none">
                        <div class="card h-100 position-relative">
                            <img src="{{ asset($category->image->getUrl()) }}" class="card-img-top" alt="{{ $category->title }}"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center position-absolute bottom-0 start-50 translate-middle-x">
                                <h5 class="card-title text-white">{{ $category->title }}</h5>
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
        .card {
            overflow: hidden; /* Скрывает лишние части, если необходимо */
        }
    </style>
@endsection
