<?php

namespace App\Http\Controllers;

use App\Enums\LanguageEnum;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function locale(string $locale)
    {
        if (!LanguageEnum::tryFrom($locale)) {
            abort(400);
        }

        Session::put('locale', $locale);
        App::setLocale($locale);

        return redirect()->back();
    }
}
