<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Document;
use App\Models\Collection;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentCollectionsTest extends TestCase
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
    public function it_gets_document_collections()
    {
        $document = Document::factory()->create();
        $collection = Collection::factory()->create();

        $document->collections()->attach($collection);

        $response = $this->getJson(
            route('api.documents.collections.index', $document)
        );

        $response->assertOk()->assertSee($collection->name);
    }

    /**
     * @test
     */
    public function it_can_attach_collections_to_document()
    {
        $document = Document::factory()->create();
        $collection = Collection::factory()->create();

        $response = $this->postJson(
            route('api.documents.collections.store', [$document, $collection])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $document
                ->collections()
                ->where('collections.id', $collection->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_collections_from_document()
    {
        $document = Document::factory()->create();
        $collection = Collection::factory()->create();

        $response = $this->deleteJson(
            route('api.documents.collections.store', [$document, $collection])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $document
                ->collections()
                ->where('collections.id', $collection->id)
                ->exists()
        );
    }
}
