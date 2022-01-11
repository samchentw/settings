<?php

namespace Samchentw\Settings\Tests\Feature;

use Samchentw\Settings\Tests\TestCase;
use Samchentw\Settings\Contracts\SettingManager;

class GetSettingTest extends TestCase
{
    /**
     * get globel value
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


    /**
     * get user value
     *
     * @return void
     */
    public function test_get_user_setting()
    {
        $this->migrate();
        $setting = app(SettingManager::class);

        //set setting
        $setting->setByKey("example.user.count", 1000, "U", 2);

        //get setting
        $user1 = $setting->getByKey("example.user.count", "U", 1);
        $user2 = $setting->getByKey("example.user.count", "U", 2);

        $this->assertEquals(1, $user1->value);
        $this->assertEquals(1000, $user2->value);
    }



    public function test_number()
    {
        $this->migrate();
        $setting = app(SettingManager::class);
        $result = $setting->getByKey("example.count");
        $this->assertTrue(gettype($result->value) == 'integer');
    }


    public function test_string()
    {
        $this->migrate();
        $setting = app(SettingManager::class);
        $result = $setting->getByKey("example.title");
        $this->assertTrue(gettype($result->value) == 'string');
    }


    public function test_boolean()
    {
        $this->migrate();
        $setting = app(SettingManager::class);
        $result = $setting->getByKey("test.boolean");
        $this->assertTrue(gettype($result->value) == 'boolean');
    }


    public function test_json()
    {
        $this->migrate();
        $setting = app(SettingManager::class);
        $result = $setting->getByKey("test.json");
        $this->assertTrue(gettype($result->value) == 'array');
    }

    public function test_date()
    {
        $this->migrate();
        $setting = app(SettingManager::class);
        $result = $setting->getByKey("test.date");
        $this->assertTrue(strtotime($result->value) != false);
    }

 
}
