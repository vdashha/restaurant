<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function handle($request)
    {
        Auth::attempt($request->only('email', 'password'));
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return redirect()->route('user.login')->withErrors([
            'password' => 'Неправильный пароль.',
        ])->withInput();
    }

    public function registration($request)
    {
        User::create($request->all());
        Auth::attempt($request->only('email', 'password'));
        return redirect()->route('home');
    }
}
