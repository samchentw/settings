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
        $result = $setting->getByKey("example.count");
        $this->assertEquals(100, $result->value);
    }

   
}
