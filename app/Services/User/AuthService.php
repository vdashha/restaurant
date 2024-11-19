<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function save_url()
    {
        Auth::attempt($request->only('email', 'password'));
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }
    }

    public function handle($request)
    {
        return Auth::attempt($request->only('email', 'password'));
    }

    public function registration($request)
    {
        $user = User::create($request->all());
        Auth::login($user);
    }
}
