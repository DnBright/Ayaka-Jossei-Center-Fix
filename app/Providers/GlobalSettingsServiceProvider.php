<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Support\Facades\Schema;

class GlobalSettingsServiceProvider extends ServiceProvider
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
        // Share settings and pages with all views
        // We use Schema::hasTable to prevent errors during initial migration
        View::composer(['user.*', 'layouts.app', 'auth.*'], function ($view) {
            try {
                if (Schema::hasTable('settings')) {
                    $settings = Setting::first();
                    $view->with('settings', $settings);
                }

                if (Schema::hasTable('pages')) {
                    $pages = Page::all()->keyBy('slug');
                    $view->with('pages', $pages);
                }
            } catch (\Exception $e) {
                // Fail silently if database is not ready
            }
        });
    }
}
