<?php

namespace App\Services\User;

use App\Models\Client;
use App\Repositories\ClientRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService
{

    public function __construct(private ClientRepository $clientRepository)
    {

    }

    public function save_url()
    {
        $previousUrl = url()->previous();
        if ($previousUrl !== route('client.login.form') && $previousUrl !== route('client.signup')) {
            session()->put('url.intended', $previousUrl);
        }
    }

    public function handle(Request $request)
    {
        return Auth::guard('client')->attempt($request->only('email', 'password'));
    }

    public function registration(Request $request)
    {
        $user = $this->clientRepository->create($request->all());
        Log::info('User register successfully', ['user_id' => $user->id]);
        Auth::guard('client')->login($user);
    }

    public function logout(): void
    {
        Auth::guard('client')->logout();
    }
}
