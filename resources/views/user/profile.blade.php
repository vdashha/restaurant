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

            <div class="mb-3">
                <label for="phone" class="form-label">Номер телефона</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+375 (__) ___-__-__" pattern="\+375 \(\d{2}\) \d{3}-\d{2}-\d{2}" required>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function (e) {
                let value = phoneInput.value.replace(/\D/g, ''); // Убираем все символы, кроме цифр
                if (value.length > 3 && value.length <= 5) {
                    value = '+375 (' + value.slice(3);
                } else if (value.length > 5 && value.length <= 8) {
                    value = '+375 (' + value.slice(3, 5) + ') ' + value.slice(5);
                } else if (value.length > 8 && value.length <= 10) {
                    value = '+375 (' + value.slice(3, 5) + ') ' + value.slice(5, 8) + '-' + value.slice(8);
                } else if (value.length > 10) {
                    value = '+375 (' + value.slice(3, 5) + ') ' + value.slice(5, 8) + '-' + value.slice(8, 10) + '-' + value.slice(10, 12);
                }
                phoneInput.value = value;
            });
        });

    </script>

@endsection
