<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function save_url()
    {
        $previousUrl = url()->previous();

        if ($previousUrl !== route('user.login') && $previousUrl !== route('user.signup')) {
            session()->put('url.intended', $previousUrl);
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
