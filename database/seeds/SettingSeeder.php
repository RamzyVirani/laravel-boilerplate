<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'default_language' => 'en',
                'logo'             => 'public/logo.png',
                'app_version'      => 1.0,
                'force_update'     => 1
            ]
        ]);

        DB::table('setting_translations')->insert([
            [
                'setting_id' => 1,
                'locale'         => 'en',
                'title'          => 'Infyom Ingic'
            ]
        ]);
    }
}