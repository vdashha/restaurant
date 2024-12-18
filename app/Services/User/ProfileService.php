<?php

namespace App\Services\User;

use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function update($request)
    {
        $user = Auth::guard('client')->user();
        $user->update($request->all());
        return $user;
    }
}
