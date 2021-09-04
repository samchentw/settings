<?php

namespace Samchentw\Settings\Http\Controllers\API;

use Samchentw\Settings\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Samchentw\Settings\Traits\Settings\TinymceSettingTrait;
use Samchentw\Settings\Traits\Settings\MailSettingTrait;
use Samchentw\Settings\Repositories\SettingRepository;

class SettingController extends Controller
{
    use TinymceSettingTrait, MailSettingTrait;
    private $settingRepository;

    public function __construct(SettingRepository $SettingRepository)
    {
        $this->settingRepository = $SettingRepository;
    }


    /**
     * @group SettingController(設定)
     * Setting1 取得tinymce api key
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTinymceApiKey(Request $request)
    {
        return $this->getTinymceKey();
    }

    /**
     * @group SettingController(設定)
     * Setting2 設定tinymce api key
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setTinymceApiKey(Request $request)
    {
        return $this->setTinymceKey($request->value);
    }

    /**
     * @group SettingController(設定)
     * Setting3 取得 Mail Group
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getMailGroupSetting()
    {
        return $this->getMailGroup();
    }

    /**
     * @group SettingController(設定)
     * Setting4 設定 Mail Group
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setMailGroupSetting(Request $request)
    {
        return $this->setMailGroup($request->group);
    }
}
