<?php

namespace App\Services\User;

use App\Contracts\RepositoryInterface;
use App\Models\Client;
use App\Repositories\ClientRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService
{
    public function save_url()
    {
        $previousUrl = url()->previous();
        if ($previousUrl !== route('client.login.form') && $previousUrl !== route('client.signup')) {
            session()->put('url.intended', $previousUrl);
        }
    }

    public function handle(array $data, string $guard)
    {
        return Auth::guard($guard)->attempt($data);
    }

    public function registration(array $data, string $guard, RepositoryInterface $repository)
    {
        $user = $repository->create($data);
        Log::info($guard . ' register successfully');
        Auth::guard($guard)->login($user);
    }
}
