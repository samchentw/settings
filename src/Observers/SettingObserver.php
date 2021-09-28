<?php

namespace Samchentw\Settings\Observers;

use Samchentw\Settings\Models\Setting;
use Samchentw\Settings\Helpers\SettingHelper;
class SettingObserver
{  
     /**
     * Handle the Setting "creating " event.
     *
     * @param  \Samchentw\Settings\Models\Setting  $setting
     * @return void
     */
    public function creating(Setting $setting)
    {
        SettingHelper::setDefaultNameToZero($setting);
    }
   

    /**
     * Handle the Setting "saving " event.
     *
     * @param  \Samchentw\Settings\Models\Setting  $setting
     * @return void
     */
    public function saving(Setting $setting)
    {
        SettingHelper::covertTypeToString($setting);
    }
}
