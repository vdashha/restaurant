@extends('welcome')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-5" style="width: 100%; max-width: 450px; border-radius: 10px; background-color: #ffffff;">
            <h2 class="text-center mb-4" style="color: #333;">Регистрация</h2>

            <form action="{{ route('client.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Введите ваше имя"
                           value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="surname" class="form-label">Фамилия</label>
                    <input type="text" name="surname" class="form-control" id="surname" placeholder="Введите вашу фамилию"
                           value="{{ old('surname') }}" required>
                    @if ($errors->has('surname'))
                        <div class="text-danger">{{ $errors->first('surname') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Введите ваш email"
                           value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Введите пароль" required>
                    @if ($errors->has('password'))
                        <div class="text-danger">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                           placeholder="Подтвердите пароль" required>
                    @if ($errors->has('password_confirmation'))
                        <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-warning w-100 py-2 mt-3" style="font-size: 16px; font-weight: bold;">Зарегистрироваться</button>
            </form>

            <div class="text-center mt-3">
                <small>Уже есть аккаунт? <a href="{{ route('client.login.form') }}" style="color: #f39c12;">Войти</a></small>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            background-color: #f4f4f4;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            font-size: 14px;
            padding: 10px;
        }

        .btn-warning {
            background-color: #f39c12;
            border-color: #f39c12;
            transition: background-color 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e67e22;
            border-color: #e67e22;
        }

        .text-danger {
            font-size: 12px;
            margin-top: 5px;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection
