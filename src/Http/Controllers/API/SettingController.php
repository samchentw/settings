<?php

namespace Samchentw\Settings\Http\Controllers\API;

use Samchentw\Settings\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Samchentw\Settings\Traits\Settings\TinymceSettingTrait;
use Samchentw\Settings\Traits\Settings\MailSettingTrait;
use Samchentw\Settings\Repositories\SettingRepository;
use Samchentw\Settings\Contracts\SettingManager;
use Illuminate\Filesystem\Filesystem;
class SettingController extends Controller
{
    use TinymceSettingTrait, MailSettingTrait;
    private $settingManager;

    public function __construct(SettingManager $SettingManager)
    {
        $this->settingManager = $SettingManager;
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


    /**
     * @group SettingController(設定)
     * Setting5 resetSettingJsonFile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetSettingJsonFile(Request $request)
    {
        $request->validate([
            'input' => ['string', 'required']
        ]);

        $input = $request->get('input');
        $path = config('setting.file_path');
        $json = json_decode($input);
        $json_string = json_encode($json, JSON_PRETTY_PRINT);
        (new Filesystem)->put($path, $json_string, true);
    }
}
