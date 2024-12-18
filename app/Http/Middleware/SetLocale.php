<?php

namespace App\Http\Middleware;

use App\Enums\LanguageEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale'); // Получаем значение префикса locale из маршрута

        // Получаем список поддерживаемых языков из конфигурации Laravel
        $locales = LanguageEnum::values();

        if ($locale) {
            if (!in_array($locale, $locales)) {
                abort(404);
            }
            App::setLocale($locale); // Устанавливаем локаль равной значению префикса locale
        } else {
            self::setLocale($request);
        }

        return $next($request);
    }

    public function setLocale(Request $request): string
    {
        // Получаем текущий язык из сессии
        $locale = Session::get('locale');
        if ($locale) {
            App::setLocale($locale);
        } else {
            $locale = self::setDefaultLocale($request);
        }
        return $locale;
    }

    public function setDefaultLocale(Request $request): string
    {

        if (Session::has('locale')) {
            return Session::get('locale');
        }

        $locales = LanguageEnum::values();
        $browserLocales = $request->getLanguages();

        foreach ($browserLocales as $locale) {
            if (in_array($locale, $locales)) {
                // Если найден поддерживаемый язык, устанавливаем его как локаль приложения и сохраняем в сессии
                App::setLocale($locale);
                Session::put('locale', $locale);
                return $locale;
            }
        }

        // Если ни один из языков браузера не поддерживается приложением, устанавливаем английский язык по умолчанию
        $locale = 'ru';
        App::setLocale($locale);
        Session::put('locale', $locale);
        return $locale;
    }
}
