<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind custom AccountInfoRequest for proper email validation
        $this->app->bind(
            \Backpack\CRUD\app\Http\Requests\AccountInfoRequest::class,
            \App\Http\Requests\AccountInfoRequest::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
