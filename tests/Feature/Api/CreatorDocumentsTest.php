<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Creator;
use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatorDocumentsTest extends TestCase
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
    public function it_gets_creator_documents()
    {
        $creator = Creator::factory()->create();
        $document = Document::factory()->create();

        $creator->documents()->attach($document);

        $response = $this->getJson(
            route('api.creators.documents.index', $creator)
        );

        $response->assertOk()->assertSee($document->slug);
    }

    /**
     * @test
     */
    public function it_can_attach_documents_to_creator()
    {
        $creator = Creator::factory()->create();
        $document = Document::factory()->create();

        $response = $this->postJson(
            route('api.creators.documents.store', [$creator, $document])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $creator
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_documents_from_creator()
    {
        $creator = Creator::factory()->create();
        $document = Document::factory()->create();

        $response = $this->deleteJson(
            route('api.creators.documents.store', [$creator, $document])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $creator
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }
}
