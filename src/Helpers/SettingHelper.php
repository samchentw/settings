<?php

namespace Samchentw\Settings\Helpers;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Http\Request;
use Samchentw\Settings\Models\Setting;

class SettingHelper
{
    public static function convertType(Setting $setting)
    {
        switch ($setting->type) {
            case Setting::TYPES['Number']:
                $setting->value = (int)$setting->value;
                break;
            case Setting::TYPES['Boolean']:
                $setting->value = ($setting->value == '1') ? true : false;
                break;
            case Setting::TYPES['Date']:
                $date = strtotime($setting->value);
                $setting->value = date('Y-m-d', $date);
                break;
            case Setting::TYPES['DateTime']:
                $date = strtotime($setting->value);
                $setting->value = date('Y-m-d H:i:s', $date);
                break;
        }
    }


    public static function covertTypeToString(Setting $setting)
    {
        switch ($setting->type) {
            case Setting::TYPES['Number']:
                $setting->value = (string)$setting->value;
                break;
            case Setting::TYPES['Boolean']:
                $setting->value = (string)$setting->value;
                break;
            case Setting::TYPES['Date']:
                $setting->value = (string)$setting->value;
                break;
            case Setting::TYPES['DateTime']:
                $setting->value = (string)$setting->value;
                break;
        }
    }
}
