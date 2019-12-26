<?php

namespace Tests\Traits;

use \App;
use Faker\Factory as Faker;
use App\Models\EmailTemplate;
use App\Repositories\Admin\EmailTemplateRepository;

trait MakeEmailTemplateTrait
{
    /**
     * Create fake instance of EmailTemplate and save it in database
     *
     * @param array $emailTemplateFields
     * @return EmailTemplate
     */
    public function makeEmailTemplate($emailTemplateFields = [])
    {
        /** @var EmailTemplateRepository $emailTemplateRepo */
        $emailTemplateRepo = App::make(EmailTemplateRepository::class);
        $theme             = $this->fakeEmailTemplateData($emailTemplateFields);
        return $emailTemplateRepo->create($theme);
    }

    /**
     * Get fake instance of EmailTemplate
     *
     * @param array $emailTemplateFields
     * @return EmailTemplate
     */
    public function fakeEmailTemplate($emailTemplateFields = [])
    {
        return new EmailTemplate($this->fakeEmailTemplateData($emailTemplateFields));
    }

    /**
     * Get fake data of EmailTemplate
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEmailTemplateData($emailTemplateFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'key'       => $fake->word,
            'html_body' => $fake->text,
            'text_body' => $fake->text,
//            'created_at' => $fake->date('Y-m-d H:i:s'),
//            'updated_at' => $fake->date('Y-m-d H:i:s'),
//            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $emailTemplateFields);
    }
}
