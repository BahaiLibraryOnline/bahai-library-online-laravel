<?php

namespace Tests\Feature\Api;

use App\Models\Tag;
use App\Models\User;
use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagDocumentsTest extends TestCase
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
    public function it_gets_tag_documents()
    {
        $tag = Tag::factory()->create();
        $document = Document::factory()->create();

        $tag->documents()->attach($document);

        $response = $this->getJson(route('api.tags.documents.index', $tag));

        $response->assertOk()->assertSee($document->slug);
    }

    /**
     * @test
     */
    public function it_can_attach_documents_to_tag()
    {
        $tag = Tag::factory()->create();
        $document = Document::factory()->create();

        $response = $this->postJson(
            route('api.tags.documents.store', [$tag, $document])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $tag
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_documents_from_tag()
    {
        $tag = Tag::factory()->create();
        $document = Document::factory()->create();

        $response = $this->deleteJson(
            route('api.tags.documents.store', [$tag, $document])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $tag
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }
}
