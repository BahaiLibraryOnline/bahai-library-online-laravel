<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Document;
use App\Models\Collection;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollectionDocumentsTest extends TestCase
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
    public function it_gets_collection_documents()
    {
        $collection = Collection::factory()->create();
        $document = Document::factory()->create();

        $collection->documents()->attach($document);

        $response = $this->getJson(
            route('api.collections.documents.index', $collection)
        );

        $response->assertOk()->assertSee($document->slug);
    }

    /**
     * @test
     */
    public function it_can_attach_documents_to_collection()
    {
        $collection = Collection::factory()->create();
        $document = Document::factory()->create();

        $response = $this->postJson(
            route('api.collections.documents.store', [$collection, $document])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $collection
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_documents_from_collection()
    {
        $collection = Collection::factory()->create();
        $document = Document::factory()->create();

        $response = $this->deleteJson(
            route('api.collections.documents.store', [$collection, $document])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $collection
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }
}
