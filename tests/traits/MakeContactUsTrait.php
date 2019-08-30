<?php

use Faker\Factory as Faker;
use App\Models\ContactUs;
use App\Repositories\Admin\ContactUsRepository;

trait MakeContactUsTrait
{
    /**
     * Create fake instance of ContactUs and save it in database
     *
     * @param array $contactUsFields
     * @return ContactUs
     */
    public function makeContactUs($contactUsFields = [])
    {
        /** @var ContactUsRepository $contactUsRepo */
        $contactUsRepo = App::make(ContactUsRepository::class);
        $theme = $this->fakeContactUsData($contactUsFields);
        return $contactUsRepo->create($theme);
    }

    /**
     * Get fake instance of ContactUs
     *
     * @param array $contactUsFields
     * @return ContactUs
     */
    public function fakeContactUs($contactUsFields = [])
    {
        return new ContactUs($this->fakeContactUsData($contactUsFields));
    }

    /**
     * Get fake data of ContactUs
     *
     * @param array $postFields
     * @return array
     */
    public function fakeContactUsData($contactUsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'message' => $fake->text,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $contactUsFields);
    }
}
