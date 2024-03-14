<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'notification_settings_text' => 'قم بإضافة فصائل الدم التي تريد تلقى الإشعارات بشأنها،وإضافة المحافظات التي تستطيع التبرع فيها.', 
            'about_app' => 'صمم Blood-Bank بكل الحب، ليصل الدم إلى مستحقيه', 
            'phone' => '01092210040', 
            'email' => 'blood.bank@gmail.com', 
            'fb_link' => 'facebook.com/blood_bank', 
            'tw_link' => 'x.com/blood_bank', 
            'insta_link' => 'instgram.com/blood_bank', 
            'youtube_link' => 'youtube.com/blood_bank', 
        ]);
    }
}
