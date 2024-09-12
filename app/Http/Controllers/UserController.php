<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showLoginForm()
    {
        return view('login.auth');
    }

    public function showRegistrationForm()
    {
        return view('login.signup');
    }

    public function store(RegistrationRequest $request)
    {
        User::create($request->all());
        return redirect()->intended('home');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return redirect()->route('user.login')->withErrors([
            'password' => 'Неправильный пароль.',
        ])->withInput();
    }

    public function showProfile()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function updateProfile(UpdateRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        return view('profile', compact('user'));
    }

}
