<?php

namespace Samchentw\Settings\Observers;

use Samchentw\Settings\Models\Setting;
use Samchentw\Settings\Helpers\SettingHelper;
class SettingObserver
{  
    public function creating(Setting $setting)
    {
        SettingHelper::setDefaultNameToZero($setting);
    }
   

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
