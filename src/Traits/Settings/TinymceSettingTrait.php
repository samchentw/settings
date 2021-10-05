<?php

namespace Samchentw\Settings\Traits\Settings;

use Exception;
use Illuminate\Http\Request;


trait TinymceSettingTrait
{
    /**
     * @var Samchentw\Settings\Contracts\SettingManager;
     */
    private $settingManager;

    // setting Key
    private $tinymceKey = "tinymce.api.key";

    /**
     *  取得tinymce api的值
     */
    public function getTinymceKey()
    {
        $apiKey = $this->settingManager->getByKey($this->tinymceKey);
        return $apiKey;
    }

    /**
     *  設定tinymce api的值
     */
    public function setTinymceKey(string $value)
    {
        $this->settingManager->setByKey($this->tinymceKey, $value);
    }
}
