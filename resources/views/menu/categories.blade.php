@extends('welcome')

@section('content')

    <div class="container my-5">
        <h2 class="text-center">Категории меню</h2>
        <div class="row justify-content-center">
            @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($category->image) }}" class="card-img-top" alt="{{ $category->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $category->title }}</h5>
                            <div class="mt-auto">
                                <a href="#" class="btn btn-primary">Посмотреть блюда</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
