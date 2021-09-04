<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Samchentw\Settings\Http\Controllers\API\SettingController;




Route::prefix('setting')->name('setting.')->middleware(['api'])->group(function(){
    Route::get('tinymce-api-key', [SettingController::class,'getTinymceApiKey']);
    Route::put('tinymce-api-key', [SettingController::class,'setTinymceApiKey']);

    Route::get('system-mail-group', [SettingController::class,'getMailGroupSetting']);
    Route::put('system-mail-group', [SettingController::class,'setMailGroupSetting']);
});



