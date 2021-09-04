<?php

namespace Samchentw\Settings\Repositories;

use Illuminate\Http\Request;
use Samchentw\Settings\Models\Setting;
use Samchentw\Common\Repositories\Base\Repository;
use Samchentw\Settings\Helpers\SettingHelper;

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
     *  @todo 重構
     *  @author Sam     
     */
    public function getByKey(string $key, $provider_name = 'G', $provider_key = null)
    {
        $query = $this->getQuery();
        $query->where('key', $key)->where('provider_name', $provider_name);

        if (!$this->isGlobal($provider_name)) {
            $query->where('provider_key', $provider_key);

            if ($query->first() == null) {
                $defaultSetting = $this->getDefaultSetting($key, $provider_name);

                return $this->create([
                    'key' => $key,
                    'value' => $defaultSetting->value,
                    'display_name' => $defaultSetting->display_name,
                    'sort' => $defaultSetting->sort,
                    'type' => $defaultSetting->type,
                    'provider_key' => $provider_key,
                    'provider_name' => $defaultSetting->provider_name
                ]);
            }
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
    public function getByFirstWord(string $word)
    {
        $query = $this->getQuery();
        $query->where('key', 'like', $word . '.%')
            ->where('provider_name', 'G')
            ->orderBy('sort');

        $settings = $query->get()->all();

        foreach ($settings as $setting) {
            SettingHelper::convertType($setting);
        }

        return $settings;
    }


    /**
     *  修改某個key的value    
     *  @return Setting  
     *  @todo 重構
     *  @author Sam   
     */
    public function setByKey(string $key,  $value, $provider_name = 'G', $provider_key = null)
    {
        if (!$this->isGlobal($provider_name)) {
            $data = $this->model->where('key', $key)
                ->where('provider_name', $provider_name)
                ->where('provider_key', $provider_key);

            if ($data->first() == null) {
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
                return $data->update(['value' => $value]);
            }
        } else {
            return $this->model->where('key', $key)
                ->where('provider_name', $provider_name)
                ->update(['value' => $value]);
        }
    }

    private function getDefaultSetting($key, $provider_name)
    {
        return $this->model->where('key', $key)
            ->where('provider_name', $provider_name)
            ->where('provider_key', 0)
            ->first();
    }

    private function isGlobal($input)
    {
        return $input == 'G';
    }
}
