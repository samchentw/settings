<?php

namespace Samchentw\Settings\Tests\Feature;

use Samchentw\Settings\Tests\TestCase;
use Samchentw\Settings\Contracts\SettingManager;
class ExampleTest extends TestCase
{
    /**
     * test
     *
     * @return void
     */
    public function test_example()
    {
        $this->migrate();

        $setting = app(SettingManager::class);
        $setting->getByKey("example.user.count");
        $this->assertIsBool(true);
    }

    protected function migrate()
    {
        $this->artisan('migrate')->run();
    }
}
