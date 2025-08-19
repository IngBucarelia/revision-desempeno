<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon; // Añade esta línea

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
    public function boot()
    {
        // Añade estas líneas dentro del método boot()
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES.utf8'); // Para Linux/Mac
        // setlocale(LC_TIME, 'spanish'); // Para Windows
    }
}
