<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Components\carte\formules;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('carte.formules', formules::class);
    }
}
