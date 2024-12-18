@extends('layout.pattern')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 m-1">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('client.login')}}">Exit</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection
