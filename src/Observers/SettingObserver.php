<?php

namespace Samchentw\Settings\Observers;

use Samchentw\Settings\Models\Setting;
use Samchentw\Settings\Helpers\SettingHelper;
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
