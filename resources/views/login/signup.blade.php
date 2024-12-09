@extends('welcome')
@section('content')
    <div>
        <form action="{{ route('client.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                       value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="surname">Surname</label>
                <input type="text" name="surname" class="form-control" id="surname" placeholder="Surname"
                       value="{{ old('surname') }}">
                @if ($errors->has('surname'))
                    <span class="text-danger">{{ $errors->first('surname') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                       value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="password_confirmation">Repeat the password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                       placeholder="Confirm password">
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
