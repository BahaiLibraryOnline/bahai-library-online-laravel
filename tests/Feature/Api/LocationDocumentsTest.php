<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Location;
use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationDocumentsTest extends TestCase
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
    public function it_gets_location_documents()
    {
        $location = Location::factory()->create();
        $document = Document::factory()->create();

        $location->documents()->attach($document);

        $response = $this->getJson(
            route('api.locations.documents.index', $location)
        );

        $response->assertOk()->assertSee($document->slug);
    }

    /**
     * @test
     */
    public function it_can_attach_documents_to_location()
    {
        $location = Location::factory()->create();
        $document = Document::factory()->create();

        $response = $this->postJson(
            route('api.locations.documents.store', [$location, $document])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $location
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_documents_from_location()
    {
        $location = Location::factory()->create();
        $document = Document::factory()->create();

        $response = $this->deleteJson(
            route('api.locations.documents.store', [$location, $document])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $location
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }
}
