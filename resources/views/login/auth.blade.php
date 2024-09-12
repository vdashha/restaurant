@extends('welcome')
@section('content')
    <div>

        <form action="{{route('login')}}" method="get">
            @csrf
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                       value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class=" text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class=" text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Sing in</button>
        </form>
    </div>
@endsection
