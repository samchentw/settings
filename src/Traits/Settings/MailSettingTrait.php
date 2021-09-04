<?php

namespace Samchentw\Settings\Traits\Settings;

use Illuminate\Support\Str;

trait MailSettingTrait
{
    /**
     * @var App\Repositories\SettingRepository;
     */
    private $settingRepository;


     //setting Key
     private $mailGroup = "mail";



      // get group setting
    public function getMailGroup()
    {
        $result = $this->settingRepository->getByFirstWord($this->mailGroup);
        return $result;
    }


    // 設定group setting
    public function setMailGroup($arrays)
    {
        foreach ($arrays as $data) {
            if (!Str::startsWith($data['key'], $this->mailGroup . '.')) continue;
            $this->settingRepository->setByKey($data['key'],$data['value']);
        }
    }

}