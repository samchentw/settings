<?php

namespace Samchentw\Settings\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Samchentw\Settings\SettingServiceProvider;

class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            SettingServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['migrator']->path(__DIR__.'/../database/migrations');
        $app['config']->set('setting.default_provider_name','G');
        $app['config']->set('setting.customer_provider_name',['A','B']);
        $app['config']->set('setting.file_path', __DIR__.'/../database/data/settings.json');
        $app['config']->set('setting.setting_web_enable',true);
    }

    protected function migrate()
    {
        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }
}
