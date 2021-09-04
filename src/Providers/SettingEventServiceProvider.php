<?php

namespace Samchentw\Settings\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Samchen\Settings\Observers\SettingObserver;
use Samchen\Settings\Models\Setting;


class SettingEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
      
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Setting::observe(SettingObserver::class);
    }
}
