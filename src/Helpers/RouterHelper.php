<?php

namespace Samchentw\Settings\Helpers;

use Illuminate\Support\Facades\Route;
use Samchentw\Settings\Http\Controllers\API\SettingController;
use Samchentw\Settings\Http\Controllers\Web\WebController;

class RouterHelper
{

    public static function loadWebRoutes()
    {
        Route::prefix('/api/setting')->name('setting.')->group(function () {
            Route::put('reset-settings-json', [SettingController::class, 'resetSettingJsonFile']);
        });

        Route::prefix('samchentw/setting')->name('samchentw.setting.')->group(function () {
            Route::get('/index', [WebController::class, 'index']);
        });
    }

}