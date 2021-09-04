<?php

namespace Samchentw\Settings\Traits\Settings;

use Exception;
use Illuminate\Http\Request;


trait TinymceSettingTrait
{
    /**
     * @var Samchen\Settings\Repositories\SettingRepository;
     */
    private $settingRepository;

    // setting Key
    private $tinymceKey = "tinymce.api.key";

    /**
     *  取得tinymce api的值
     */
    public function getTinymceKey()
    {
        $apiKey = $this->settingRepository->getByKey($this->tinymceKey);
        return $apiKey;
    }

    /**
     *  設定tinymce api的值
     */
    public function setTinymceKey(string $value)
    {
        $this->settingRepository->setByKey($this->tinymceKey, $value);
    }
}
