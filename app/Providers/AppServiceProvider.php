<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) {
//            cache()->forget('settings');
            $settings = cache()->rememberForever('settings', function () {
                $path = resource_path('seeders/settings.json');

                return (object)json_decode(file_get_contents($path), true);
            });

            $vars = [
                'settings' => (object)$settings,
            ];

            $view->with($vars);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
