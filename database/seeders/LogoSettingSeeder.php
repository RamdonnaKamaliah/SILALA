<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class LogoSettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'key' => 'logo_admin_sidebar',
                'label' => 'Logo Sidebar Admin',
                'group' => 'logos',
                'value' => 'default/BPMSPH-logo.svg' 
            ],
            [
                'key' => 'logo_user_sidebar',
                'label' => 'Logo Sidebar User',
                'group' => 'logos',
                'value' => 'default/logo_kementan.svg'
            ],
            [
                'key' => 'logo_hero_section',
                'label' => 'Logo Hero Section',
                'group' => 'logos',
                'value' => 'default/hero1.png'
            ],
            [
                'key' => 'logo_footer_landing',
                'label' => 'Logo Footer Landing',
                'group' => 'logos',
                'value' => 'default/logo_kementan.svg'
            ],
            [
                'key' => 'logo_footer_user',
                'label' => 'Logo Footer User',
                'group' => 'logos',
                'value' => 'default/logo_kementan.svg'
            ],
            [
                'key' => 'background_landing',
                'label' => 'Background Landing',
                'group' => 'background',
                'value' => 'default/background.png'
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'label' => $setting['label'],
                    'group' => $setting['group'],
                    'value' => $setting['value']
                ]
            );
        }
    }
}