<?php

namespace App\Providers;

use App\Models\Service;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

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
        View::composer('elements.footer', function ($view): void {
            try {
                $footerServices = Service::whereNotNull('slug')
                    ->where('slug', '!=', '')
                    ->orderBy('created_at', 'asc')
                    ->get(['id', 'name', 'slug']);
            } catch (Throwable) {
                $footerServices = collect();
            }

            $view->with('footerServices', $footerServices);
        });
    }
}
