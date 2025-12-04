<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Services\User\AuthService;
use App\Services\User\ProfileService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(private readonly AuthService $authService)
    {

    }

    public function showLoginForm()
    {
        $previousUrl = url()->previous();
        if ($previousUrl !== route('client.login.form') && $previousUrl !== route('client.signup')) {
            session()->put('url.intended', $previousUrl);
        }

        return view('login.auth');
    }

    public function showRegistrationForm()
    {
        $this->authService->save_url();

        return view('login.signup');
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {
        $this->authService->registration($request);

        return redirect()->intended('/');
    }

    public function login(LoginRequest $request)
    {
        if ($this->authService->handle($request)) {
            return redirect()->intended('/');
        }

        return redirect()->route('client.login')->withErrors([
            'password' => 'Неправильный пароль.',
        ])->withInput();
    }

    public function logout(): RedirectResponse
    {
       $this->authService->logout();

        return redirect()->back();
    }

    public function showProfile()
    {
        $user = Auth::guard('client')->user();

        return view('user.profile', compact('user'));
    }

    public function updateProfile(UpdateRequest $request, ProfileService $profileService)
    {
        $user = $profileService->update($request);

        return view('user.profile', compact('user'));
    }

}
