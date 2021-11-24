<?php

namespace Samchentw\Settings\Http\Controllers\Web;

use Samchentw\Settings\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Samchentw\Settings\Traits\Settings\TinymceSettingTrait;
use Samchentw\Settings\Traits\Settings\MailSettingTrait;
use Samchentw\Settings\Repositories\SettingRepository;
use Samchentw\Settings\Contracts\SettingManager;

class WebController extends Controller
{


    public function index()
    {
        $fileDatas = file_get_contents(database_path('data/settings.json'));
        $settings = json_decode($fileDatas);
        $providerName = collect(['U'])->concat(config('setting.customer_provider_name', []));
        $defaultproviderName = config('setting.default_provider_name', []);
        return view('setting::index', compact( 'settings', 'providerName', 'defaultproviderName'));
    }
}
