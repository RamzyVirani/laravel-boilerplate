<?php

use App\Models\Language;
use App\Repositories\Admin\LanguageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LanguageRepositoryTest extends TestCase
{
    use MakeLanguageTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LanguageRepository
     */
    protected $languageRepo;

    public function setUp()
    {
        parent::setUp();
        $this->languageRepo = App::make(LanguageRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLanguage()
    {
        $language = $this->fakeLanguageData();
        $createdLanguage = $this->languageRepo->create($language);
        $createdLanguage = $createdLanguage->toArray();
        $this->assertArrayHasKey('id', $createdLanguage);
        $this->assertNotNull($createdLanguage['id'], 'Created Language must have id specified');
        $this->assertNotNull(Language::find($createdLanguage['id']), 'Language with given id must be in DB');
        $this->assertModelData($language, $createdLanguage);
    }

    /**
     * @test read
     */
    public function testReadLanguage()
    {
        $language = $this->makeLanguage();
        $dbLanguage = $this->languageRepo->find($language->id);
        $dbLanguage = $dbLanguage->toArray();
        $this->assertModelData($language->toArray(), $dbLanguage);
    }

    /**
     * @test update
     */
    public function testUpdateLanguage()
    {
        $language = $this->makeLanguage();
        $fakeLanguage = $this->fakeLanguageData();
        $updatedLanguage = $this->languageRepo->update($fakeLanguage, $language->id);
        $this->assertModelData($fakeLanguage, $updatedLanguage->toArray());
        $dbLanguage = $this->languageRepo->find($language->id);
        $this->assertModelData($fakeLanguage, $dbLanguage->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLanguage()
    {
        $language = $this->makeLanguage();
        $resp = $this->languageRepo->delete($language->id);
        $this->assertTrue($resp);
        $this->assertNull(Language::find($language->id), 'Language should not exist in DB');
    }
}
