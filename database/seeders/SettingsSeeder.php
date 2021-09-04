<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents("database/data/settings.json");
        $settings = json_decode($file);

        foreach ($settings as $setting) {
            $check = DB::table('settings')->where('key', $setting->key)->first();

            if (empty($check)) {
                DB::table('settings')->insert([
                    'key' => $setting->key,
                    'value' => $setting->value,
                    'display_name' => $setting->display_name,
                    'type' => $setting->type,
                    'sort' => $setting->sort,
                    'provider_key' => $setting->provider_key,
                    'provider_name' => $setting->provider_name
                ]);
            }
        }
    }
}
