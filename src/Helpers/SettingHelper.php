<?php

namespace Samchentw\Settings\Helpers;

use Exception;
use Samchentw\Settings\Models\Setting;

class SettingHelper
{
    public static function getSettingFromFile()
    {
        // dump(config('setting.file_path'));
        $file = file_get_contents(config('setting.file_path'));
       
        $settingFromFile = collect(json_decode($file));
        return $settingFromFile;
    }

    /**
     * 將預設provider_name的provider_key設為0
     */
    public static function setDefaultNameToZero(Setting $setting)
    {
        if ($setting->provider_name == '') $setting->provider_name = static::getDefaultProviderName();
        if ($setting->provider_name == static::getDefaultProviderName()) $setting->provider_key = 0;
        return $setting;
    }

    /**
     * 是否為已註冊 providerName
     */
    public static function checkHaveProviderName($providerName)
    {
        $defaultKey = ['G', 'U'];
        $customerKey =  config('setting.customer_provider_name', []);
        $keys = array_unique(array_merge($defaultKey, $customerKey));
        $result = in_array($providerName, $keys);
        if (!$result) throw new Exception($providerName . '為不合法providerName');
    }

    /**
     * 取得預設ProviderName
     */
    public static function getDefaultProviderName()
    {
        $defaultKey = config('setting.default_provider_name', 'G');
        $customerKey = config('setting.customer_provider_name', []);

        if (in_array($defaultKey, $customerKey)) return $defaultKey;
        else return 'G';
    }

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
            case Setting::TYPES['Json']:
                $setting->value = json_decode($setting->value);
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
                $setting->value = $setting->value ? '1' : '0';;
                break;
            case Setting::TYPES['Date']:
                $setting->value = (string)$setting->value;
                break;
            case Setting::TYPES['DateTime']:
                $setting->value = (string)$setting->value;
                break;
            case Setting::TYPES['Json']:
                if (is_array($setting->value)) {
                    $setting->value = json_encode($setting->value);
                } else $setting->value = '[]';
                break;
        }
    }
}
