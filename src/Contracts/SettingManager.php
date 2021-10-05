<?php

namespace Samchentw\Settings\Contracts;

interface SettingManager
{

    /**
     * 取得key值
     */
    public function getByKey(string $key, $provider_name = '', $provider_key = null);

    /**
     * 取得群組
     */
    public function getByFirstWord(string $word, $provider_name = '', $provider_key = null);

    /**
     * 設定key的value
     */
    public function setByKey(string $key,  $value, $provider_name = '', $provider_key = null);
}
