@extends('welcome')
@section('content')
    <div class="container">
        <h1>Профиль пользователя</h1>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="surname">Фамилия</label>
                <input type="text" name="surname" class="form-control" id="surname" value="{{ old('surname', $user->surname) }}" required>
                @if ($errors->has('surname'))
                    <span class="text-danger">{{ $errors->first('surname') }}</span>
                @endif
            </div>


            <div class="form-group mb-3">
                <label for="name">Имя</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group mb-3">
                <label for="phone">Номер телефона</label>
                <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $user->phone) }}">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>

    </div>
@endsection
