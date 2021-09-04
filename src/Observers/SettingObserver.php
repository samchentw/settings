<?php

namespace Samchentw\Settings\Observers;

use Samchen\Settings\Models\Setting;
use Samchen\Settings\Helpers\SettingHelper;
class SettingObserver
{  
    /**
     * Handle the Setting "saving " event.
     *
     * @param  \Samchen\Settings\Setting  $setting
     * @return void
     */
    public function saving(Setting $setting)
    {
        SettingHelper::covertTypeToString($setting);
    }
}
