<?php

namespace App\Services\User;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function handle($request)
    {
        return Auth::guard('client')->attempt($request->only('email', 'password'));
    }

    public function registration($request)
    {
        $user = Client::create($request->all());
        Auth::guard('client')->login($user);
    }
}
