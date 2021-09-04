<?php

namespace Samchentw\Settings\Providers;

use Samchen\Settings\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class SettingProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRoutes();
        $this->configurePublishing();
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../../database/migrations/2021_08_05_081049_create_settings_table.php' => database_path('migrations/2021_08_05_081049_create_settings_table.php')
        ], 'samchen-setting-migrations');

        $this->publishes([
            __DIR__ . '/../../database/seeders/SettingsSeeder.php' => database_path('seeders/SettingsSeeder.php')
        ], 'samchen-setting-seeder');

        $this->publishes([
            __DIR__ . '/../../database/data/settings.json' => database_path('data/settings.json')
        ], 'samchen-setting-seeder');
    }

    /**
     * Configure the routes offered by the application.
     *
     * @return void
     */
    protected function configureRoutes()
    {
        Route::group([
            'namespace' => 'Samchen\Settings\Http\Controllers',
            'domain' => null,
            'prefix' => 'api',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/settings.php');
        });
    }
}
