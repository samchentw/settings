<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Samchentw\Settings\Http\Controllers\API\SettingController;
use Samchentw\Settings\Http\Controllers\Web\WebController;


if (config('setting.setting_api_enable', false)) {
    Route::prefix('api/setting')->name('setting.')->middleware(['api'])->group(function () {
        Route::get('tinymce-api-key', [SettingController::class, 'getTinymceApiKey']);
        Route::put('tinymce-api-key', [SettingController::class, 'setTinymceApiKey']);

        Route::get('system-mail-group', [SettingController::class, 'getMailGroupSetting']);
        Route::put('system-mail-group', [SettingController::class, 'setMailGroupSetting']);
    });
}


if (config('setting.setting_web_enable', false)) {
    Route::prefix('samchentw/setting')->name('samchentw.setting.')->middleware(['api'])->group(function () {
        Route::get('/index', [WebController::class, 'index']);
    });
}
