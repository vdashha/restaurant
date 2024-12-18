@extends('welcome')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-5" style="width: 100%; max-width: 400px; border-radius: 8px; background-color: #ffffff;">
            <h2 class="text-center mb-4" style="color: #333;">{{ __('auth.loginForm') }}</h2>

            <form action="{{ route('client.login') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('auth.email') }}</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="{{ __('auth.enterEmail') }}"
                           value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <div class="text-danger">{{ __('auth.emailError') }}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('auth.password') }}</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('auth.enterPassword') }}" required>
                    @if ($errors->has('password'))
                        <div class="text-danger">{{ __('auth.passwordError') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-warning w-100 py-2 mt-3" style="font-size: 16px; font-weight: bold;">{{ __('auth.loginButton') }}</button>
            </form>

            <div class="text-center mt-3">
                <small>{{ __('auth.noAccount') }} <a href="{{ route('client.signup') }}" style="color: #f39c12;">{{ __('auth.signup') }}</a></small>
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
