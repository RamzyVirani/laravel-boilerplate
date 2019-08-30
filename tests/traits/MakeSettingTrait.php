<?php

use Faker\Factory as Faker;
use App\Models\Setting;
use App\Repositories\Admin\SettingRepository;

trait MakeSettingTrait
{
    /**
     * Create fake instance of Setting and save it in database
     *
     * @param array $settingFields
     * @return Setting
     */
    public function makeSetting($settingFields = [])
    {
        /** @var SettingRepository $settingRepo */
        $settingRepo = App::make(SettingRepository::class);
        $theme = $this->fakeSettingData($settingFields);
        return $settingRepo->create($theme);
    }

    /**
     * Get fake instance of Setting
     *
     * @param array $settingFields
     * @return Setting
     */
    public function fakeSetting($settingFields = [])
    {
        return new Setting($this->fakeSettingData($settingFields));
    }

    /**
     * Get fake data of Setting
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSettingData($settingFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'default_language' => $fake->word,
            'email' => $fake->word,
            'logo' => $fake->word,
            'phone' => $fake->word,
            'latitude' => $fake->word,
            'longitude' => $fake->word,
            'playstore' => $fake->word,
            'appstore' => $fake->word,
            'social_links' => $fake->text,
            'app_version' => $fake->randomDigitNotNull,
            'force_update' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $settingFields);
    }
}
