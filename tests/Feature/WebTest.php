<?php

namespace Samchentw\Settings\Tests\Feature;

use Samchentw\Settings\Tests\TestCase;
use Samchentw\Settings\Contracts\SettingManager;

class WebTest extends TestCase
{

    public function test_web()
    {
        $response = $this->get('/samchentw/setting/index');
        $response->assertStatus(200);
    }
}
