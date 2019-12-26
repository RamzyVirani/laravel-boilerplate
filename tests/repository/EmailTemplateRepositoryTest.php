<?php

namespace Tests\Repository;

use \App;
use Tests\ApiTestTrait;
use Tests\TestCase;
use App\Models\EmailTemplate;
use App\Repositories\Admin\EmailTemplateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Traits\MakeEmailTemplateTrait;

class EmailTemplateRepositoryTest extends TestCase
{
    use MakeEmailTemplateTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmailTemplateRepository
     */
    protected $emailTemplateRepo;

    public function setUp()
    {
        parent::setUp();
        $this->emailTemplateRepo = App::make(EmailTemplateRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEmailTemplate()
    {
        $emailTemplate        = $this->fakeEmailTemplateData();
        $createdEmailTemplate = $this->emailTemplateRepo->create($emailTemplate);
        $createdEmailTemplate = $createdEmailTemplate->toArray();
        $this->assertArrayHasKey('id', $createdEmailTemplate);
        $this->assertNotNull($createdEmailTemplate['id'], 'Created EmailTemplate must have id specified');
        $this->assertNotNull(EmailTemplate::find($createdEmailTemplate['id']), 'EmailTemplate with given id must be in DB');
        $this->assertModelData($emailTemplate, $createdEmailTemplate);
    }

    /**
     * @test read
     */
    public function testReadEmailTemplate()
    {
        $emailTemplate   = $this->makeEmailTemplate();
        $dbEmailTemplate = $this->emailTemplateRepo->find($emailTemplate->id);
        $dbEmailTemplate = $dbEmailTemplate->toArray();
        $this->assertModelData($emailTemplate->toArray(), $dbEmailTemplate);
    }

    /**
     * @test update
     */
    public function testUpdateEmailTemplate()
    {
        $emailTemplate        = $this->makeEmailTemplate();
        $fakeEmailTemplate    = $this->fakeEmailTemplateData();
        $updatedEmailTemplate = $this->emailTemplateRepo->update($fakeEmailTemplate, $emailTemplate->id);
        $this->assertModelData($fakeEmailTemplate, $updatedEmailTemplate->toArray());
        $dbEmailTemplate = $this->emailTemplateRepo->find($emailTemplate->id);
        $this->assertModelData($fakeEmailTemplate, $dbEmailTemplate->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEmailTemplate()
    {
        $emailTemplate = $this->makeEmailTemplate();
        $resp          = $this->emailTemplateRepo->delete($emailTemplate->id);
        $this->assertTrue($resp);
        $this->assertNull(EmailTemplate::find($emailTemplate->id), 'EmailTemplate should not exist in DB');
    }
}
