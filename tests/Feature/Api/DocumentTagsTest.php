<?php

namespace Tests\Feature\Api;

use App\Models\Tag;
use App\Models\User;
use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentTagsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_document_tags()
    {
        $document = Document::factory()->create();
        $tag = Tag::factory()->create();

        $document->tags()->attach($tag);

        $response = $this->getJson(
            route('api.documents.tags.index', $document)
        );

        $response->assertOk()->assertSee($tag->label);
    }

    /**
     * @test
     */
    public function it_can_attach_tags_to_document()
    {
        $document = Document::factory()->create();
        $tag = Tag::factory()->create();

        $response = $this->postJson(
            route('api.documents.tags.store', [$document, $tag])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $document
                ->tags()
                ->where('tags.id', $tag->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_tags_from_document()
    {
        $document = Document::factory()->create();
        $tag = Tag::factory()->create();

        $response = $this->deleteJson(
            route('api.documents.tags.store', [$document, $tag])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $document
                ->tags()
                ->where('tags.id', $tag->id)
                ->exists()
        );
    }
}
