<?php

namespace App\Providers;

use App\Models\Service;
use App\Settings\SiteSettings;
use App\Support\SiteSettingsData;
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
        View::composer('*', function ($view): void {
            try {
                $settings = app(SiteSettings::class);
            } catch (Throwable) {
                $settings = null;
            }

            $view->with('siteSettings', SiteSettingsData::fromSettings($settings));
        });

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
