<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Language;
use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageDocumentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_language_documents()
    {
        $language = Language::factory()->create();
        $document = Document::factory()->create();

        $language->documents()->attach($document);

        $response = $this->getJson(
            route('api.languages.documents.index', $language)
        );

        $response->assertOk()->assertSee($document->slug);
    }

    /**
     * @test
     */
    public function it_can_attach_documents_to_language()
    {
        $language = Language::factory()->create();
        $document = Document::factory()->create();

        $response = $this->postJson(
            route('api.languages.documents.store', [$language, $document])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $language
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_documents_from_language()
    {
        $language = Language::factory()->create();
        $document = Document::factory()->create();

        $response = $this->deleteJson(
            route('api.languages.documents.store', [$language, $document])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $language
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }
}
