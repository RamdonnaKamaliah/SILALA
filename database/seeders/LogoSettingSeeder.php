<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logos = [
            [
                'key' => 'logo_admin_sidebar',
                'label' => 'Logo Sidebar Admin',
                'group' => 'logos'
            ],
            [
                'key' => 'logo_user_sidebar',
                'label' => 'Logo Sidebar User',
                'group' => 'logos'
            ],
            [
                'key' => 'logo_hero_section',
                'label' => 'Logo Hero Section',
                'group' => 'logos'
            ],
            [
                'key' => 'logo_footer_landing',
                'label' => 'Logo Footer Landing',
                'group' => 'logos'
            ],
            [
                'key' => 'logo_footer_user',
                'label' => 'Logo Footer User',
                'group' => 'logos'
            ],
        ];

        foreach ($logos as $logo) {
            Setting::updateOrCreate(
                ['key' => $logo['key']],
                [
                    'label' => $logo['label'],
                    'group' => $logo['group'],
                    'value' => null
                ]
            );
        }
    }
}