<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailTemplateApiTest extends TestCase
{
    use MakeEmailTemplateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEmailTemplate()
    {
        $emailTemplate = $this->fakeEmailTemplateData();
        $this->json('POST', '/api/v1/emailTemplates', $emailTemplate);

        $this->assertApiResponse($emailTemplate);
    }

    /**
     * @test
     */
    public function testReadEmailTemplate()
    {
        $emailTemplate = $this->makeEmailTemplate();
        $this->json('GET', '/api/v1/emailTemplates/'.$emailTemplate->id);

        $this->assertApiResponse($emailTemplate->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEmailTemplate()
    {
        $emailTemplate = $this->makeEmailTemplate();
        $editedEmailTemplate = $this->fakeEmailTemplateData();

        $this->json('PUT', '/api/v1/emailTemplates/'.$emailTemplate->id, $editedEmailTemplate);

        $this->assertApiResponse($editedEmailTemplate);
    }

    /**
     * @test
     */
    public function testDeleteEmailTemplate()
    {
        $emailTemplate = $this->makeEmailTemplate();
        $this->json('DELETE', '/api/v1/emailTemplates/'.$emailTemplate->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/emailTemplates/'.$emailTemplate->id);

        $this->assertResponseStatus(404);
    }
}
