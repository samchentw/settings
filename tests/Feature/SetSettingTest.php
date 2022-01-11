<?php

namespace Samchentw\Settings\Tests\Feature;

use Samchentw\Settings\Tests\TestCase;
use Samchentw\Settings\Contracts\SettingManager;

class SetSettingTest extends TestCase
{
    /**
     * set json value
     *
     * @return void
     */
    public function test_json_type()
    {
        $this->migrate();
        $setting = app(SettingManager::class);

        $setting->setByKey("test.json", [["test" => 1]]);
        $result = $setting->getByKey("test.json");
        $this->assertEquals(json_decode('[{"test":1}]'), $result->value);
    }

    /**
     * set boolean value is true
     *
     * @return void
     */
    public function test_boolean_is_true()
    {
        $this->migrate();
        $setting = app(SettingManager::class);

        $setting->setByKey("test.boolean", true);
        $result = $setting->getByKey("test.boolean");
        $this->assertTrue($result->value);
    }

      /**
     * set boolean value is false
     *
     * @return void
     */
    public function test_boolean_is_false()
    {
        $this->migrate();
        $setting = app(SettingManager::class);

        $setting->setByKey("test.boolean", false);
        $result = $setting->getByKey("test.boolean");
        $this->assertFalse($result->value);
    }
}
