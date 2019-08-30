<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LanguageApiTest extends TestCase
{
    use MakeLanguageTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLanguage()
    {
        $language = $this->fakeLanguageData();
        $this->json('POST', '/api/v1/languages', $language);

        $this->assertApiResponse($language);
    }

    /**
     * @test
     */
    public function testReadLanguage()
    {
        $language = $this->makeLanguage();
        $this->json('GET', '/api/v1/languages/'.$language->id);

        $this->assertApiResponse($language->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLanguage()
    {
        $language = $this->makeLanguage();
        $editedLanguage = $this->fakeLanguageData();

        $this->json('PUT', '/api/v1/languages/'.$language->id, $editedLanguage);

        $this->assertApiResponse($editedLanguage);
    }

    /**
     * @test
     */
    public function testDeleteLanguage()
    {
        $language = $this->makeLanguage();
        $this->json('DELETE', '/api/v1/languages/'.$language->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/languages/'.$language->id);

        $this->assertResponseStatus(404);
    }
}
