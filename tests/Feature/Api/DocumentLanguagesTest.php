<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Document;
use App\Models\Language;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentLanguagesTest extends TestCase
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
    public function it_gets_document_languages()
    {
        $document = Document::factory()->create();
        $language = Language::factory()->create();

        $document->languages()->attach($language);

        $response = $this->getJson(
            route('api.documents.languages.index', $document)
        );

        $response->assertOk()->assertSee($language->language);
    }

    /**
     * @test
     */
    public function it_can_attach_languages_to_document()
    {
        $document = Document::factory()->create();
        $language = Language::factory()->create();

        $response = $this->postJson(
            route('api.documents.languages.store', [$document, $language])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $document
                ->languages()
                ->where('languages.id', $language->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_languages_from_document()
    {
        $document = Document::factory()->create();
        $language = Language::factory()->create();

        $response = $this->deleteJson(
            route('api.documents.languages.store', [$document, $language])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $document
                ->languages()
                ->where('languages.id', $language->id)
                ->exists()
        );
    }
}
