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
    }
}
