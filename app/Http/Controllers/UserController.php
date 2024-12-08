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
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showLoginForm(AuthService $authService)
    {
        $authService->save_url();
        return view('login.auth');
    }

    public function showRegistrationForm(AuthService $authService)
    {
        $authService->save_url();
        return view('login.signup');
    }

    public function store(RegistrationRequest $request, AuthService $authService)
    {
        $authService->registration($request);
        return redirect()->intended('/');

    }

    public function login(LoginRequest $request, AuthService $authService)
    {
        if ($authService->handle($request)) {
            return redirect()->intended('/');
        }

        return redirect()->route('user.login')->withErrors([
            'password' => 'Неправильный пароль.',
        ])->withInput();
    }

    public function logout(){
        Auth::guard('client')->logout();
        return redirect()->route('home');
    }


    public function showProfile()
    {
        $user = Auth::guard('client')->user();
        return view('profile', compact('user'));
    }

    public function updateProfile(UpdateRequest $request, ProfileService $profileService)
    {
        $user = $profileService->update($request);
        return view('profile', compact('user'));
    }

}
