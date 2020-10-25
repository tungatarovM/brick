<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultSettings = [
            [
                'setting_key' => 'default_avatars',
                'setting_value' => [
                    'super_admin' => 'avatars/super_admin.svg',
                    'admin' => 'avatars/admin.svg',
                    'manager' => 'avatars/manager.svg',
                    'developer' => 'developer.svg',
                    'qa' => 'qa.svg',
                ]
            ],
        ];

        foreach ($defaultSettings as $setting) {
            \App\Entity\Settings\Entities\Setting::create([
                'setting_key' => $setting['setting_key'],
                'setting_value' => json_encode($setting['setting_value']),
            ]);
        }

    }
}
