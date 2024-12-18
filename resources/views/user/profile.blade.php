@extends('welcome')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-5" style="width: 100%; max-width: 600px; border-radius: 10px; background-color: #ffffff;">
            <h2 class="text-center mb-4" style="color: #333;">{{ __('profile.userProfile') }}</h2>

            <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <!-- Фамилия -->
                <div class="mb-3">
                    <label for="surname" class="form-label">{{ __('profile.surname') }}</label>
                    <input type="text" name="surname" class="form-control" id="surname" placeholder="{{ __('profile.enterSurname') }}"  value="{{ old('surname', $user->surname) }}" required>
                    @if ($errors->has('surname'))
                        <div class="text-danger">{{ __('profile.surnameError') }}</div>
                    @endif
                </div>

                <!-- Имя -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('profile.name') }}</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('profile.enterName') }}"  value="{{ old('name', $user->name) }}" required>
                    @if ($errors->has('name'))
                        <div class="text-danger">{{ __('profile.nameError') }}</div>
                    @endif
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('profile.email') }}</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="{{ __('profile.enterEmail') }}" value="{{ old('email', $user->email) }}" required>
                    @if ($errors->has('email'))
                        <div class="text-danger">{{ __('profile.emailError') }}</div>
                    @endif
                </div>

                <!-- Номер телефона -->
                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('profile.phone') }}</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="{{ __('profile.enterPhone') }}" value="{{ old('phone', $user->phone) }}"
                           placeholder="{{ __('profile.enterPhone') }}" pattern="\+375 \(\d{2}\) \d{3}-\d{2}-\d{2}" required>
                    @if ($errors->has('phone'))
                        <div class="text-danger">{{ __('profile.phoneError') }}</div>
                    @endif
                </div>

                <!-- Кнопка сохранения изменений -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning w-100 py-2 mt-3">{{ __('profile.saveChanges') }}</button>
                </div>
            </form>
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
