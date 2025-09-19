<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    
public function panel(): Panel
{
    return Panel::make()
        ->default() // <- TO DODAJ!
        ->id('admin') // opcjonalnie
        ->path('admin') // np. /admin
        ->login()
        ->resources([
            // np. IssueResource::class,
        ])
        ->pages([
            // np. Dashboard::class,
        ]);
}
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
        //
    }
}
