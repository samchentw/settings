<?php

namespace Samchentw\Settings;

use Samchentw\Settings\Contracts\SettingManager;
use Samchentw\Settings\Repositories\SettingRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class SettingServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            SettingManager::class,
            SettingRepository::class
        );
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
        $this->configureView();
    }

    public function configureView()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'setting');
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
            __DIR__ . '/../config/setting.php' => config_path('setting.php'),
        ], 'setting-config');

        $this->publishes([
            __DIR__ . '/../database/migrations/2021_08_05_081049_create_settings_table.php' => database_path('migrations/2021_08_05_081049_create_settings_table.php')
        ], 'samchen-setting-migrations');

        // $this->publishes([
        //     __DIR__ . '/../database/seeders/SettingsSeeder.php' => database_path('seeders/SettingsSeeder.php')
        // ], 'samchen-setting-seeder');

        $this->publishes([
            __DIR__ . '/../database/data/settings.json' => database_path('data/settings.json')
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
            'prefix' => '',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/settings.php');
        });
    }
}
