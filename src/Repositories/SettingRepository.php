<?php

namespace Samchentw\Settings\Repositories;

use Exception;
use Illuminate\Http\Request;
use Samchentw\Settings\Models\Setting;
use Samchentw\Common\Repositories\Base\Repository;
use Samchentw\Settings\Helpers\SettingHelper;
use Illuminate\Support\Str;

class SettingRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Setting::class;
    }


    /**
     * 以key值取得value
     *  @return Setting
     *  @author Sam     
     */
    public function getByKey(string $key, $provider_name = '', $provider_key = null)
    {
        if ($provider_name == '') {
            $provider_name = SettingHelper::getDefaultProviderName();
            $provider_key = 0;
        }

        $query = $this->getQuery();
        $query->where('key', $key)
            ->where('provider_name', $provider_name)
            ->where('provider_key', $provider_key);

        if ($query->first() == null) {
            $defaultSetting = $this->getDefaultSetting($key, $provider_name);

            $setting = $this->create([
                'key' => $key,
                'value' => $defaultSetting->value,
                'display_name' => $defaultSetting->display_name,
                'sort' => $defaultSetting->sort,
                'type' => $defaultSetting->type,
                'provider_key' => $provider_key,
                'provider_name' => $defaultSetting->provider_name
            ]);
            SettingHelper::convertType($setting);
            return $setting;
        }

        $setting = $query->first();
        SettingHelper::convertType($setting);
        return $setting;
    }

    /**
     *  以key值的第一個參數做為搜尋條件
     *  such as：
     *  $word = video
     *  output: video.youtube.url、video.facebook.url,
     *  @return array
     */
    public function getByFirstWord(string $word, $provider_name = '', $provider_key = null)
    {
        if ($provider_name == '') {
            $provider_name = SettingHelper::getDefaultProviderName();
            $provider_key = 0;
        }

        $collection = SettingHelper::getSettingFromFile();
        $result = $collection->filter(function ($item) use ($word) {
            return Str::of($item->key)->startsWith($word.'.');
        })->where('provider_name', $provider_name)
        ->where('provider_key', $provider_key);

        if($result->count() == 0) throw new Exception('無此群組！');

        $settings = collect([]);
        foreach($result->all() as $r)
        {
            $setting = $this->getByKey($r->key,$r->provider_name,$r->provider_key);
            $settings->push($setting);
        }
        return $settings->sortBy('sort')->values()->all();
    }


    /**
     *  修改某個key的value    
     *  @return Setting  
     *  @author Sam   
     */
    public function setByKey(string $key,  $value, $provider_name = '', $provider_key = null)
    {
        if ($provider_name == '') {
            $provider_name = SettingHelper::getDefaultProviderName();
            $provider_key = 0;
        }
        $data = $this->model->where('key', $key)
            ->where('provider_name', $provider_name)
            ->where('provider_key', $provider_key)->first();

        if ($data == null) {
            $defaultSetting = $this->getDefaultSetting($key, $provider_name);

            $this->create([
                'key' => $key,
                'value' => $value,
                'display_name' => $defaultSetting->display_name,
                'sort' => $defaultSetting->sort,
                'type' => $defaultSetting->type,
                'provider_key' => $provider_key,
                'provider_name' => $defaultSetting->provider_name
            ]);
        } else {
            return $this->getModel()->find($data->id)->update(['value' => $value]);
        }
    }

    /** Private Function */

    private function getDefaultSetting($key, $provider_name)
    {
        SettingHelper::checkHaveProviderName($provider_name);
        $settingFromDB =  $this->model->where('key', $key)
            ->where('provider_name', $provider_name)
            ->where('provider_key', 0)
            ->first();

        if ($settingFromDB != null) return $settingFromDB;


        $settingFromFile = SettingHelper::getSettingFromFile();
        $fileResult = $settingFromFile
            ->where('key', $key)
            ->where('provider_name', $provider_name)
            ->where('provider_key', 0)
            ->first();

        if ($fileResult != null) return $fileResult;
        else throw new Exception('key值 ' . $key . '(' . $provider_name . ')' . ' 沒被註冊，所以無法使用！');
    }
}
