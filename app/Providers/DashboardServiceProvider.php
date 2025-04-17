<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['layouts.backend.master'], function ($view) {
            $user = auth()->user(); // Ambil data user yang sedang login
            $view->with('user', $user); // Kirim data user ke view
        });
    }
}
