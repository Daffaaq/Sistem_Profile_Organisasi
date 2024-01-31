<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Mendefinisikan directive Blade kustom bernama 'active'
        Blade::directive('active', function ($path) {
            // Mengembalikan string PHP yang akan dievaluasi oleh Blade
            return "{{ request()->is($path) ? 'active' : '' }}";
        });
    }
}
