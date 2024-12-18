<?php

namespace App\Providers;

use App\Contracts\RepositoryInterface;
use App\Repositories\BaseRepository;
use Dedoc\Scramble\Scramble;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryInterface::class, BaseRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Scramble::routes(function () {
            return collect(Route::getRoutes())->filter(function ($route) {
                return in_array('web', $route->middleware()); // Фильтр по middleware 'web'
            });
        });
    }
}
