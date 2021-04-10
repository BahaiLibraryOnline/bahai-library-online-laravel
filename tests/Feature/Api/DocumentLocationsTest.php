<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Document;
use App\Models\Location;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentLocationsTest extends TestCase
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
    public function it_gets_document_locations()
    {
        $document = Document::factory()->create();
        $location = Location::factory()->create();

        $document->locations()->attach($location);

        $response = $this->getJson(
            route('api.documents.locations.index', $document)
        );

        $response->assertOk()->assertSee($location->continent);
    }

    /**
     * @test
     */
    public function it_can_attach_locations_to_document()
    {
        $document = Document::factory()->create();
        $location = Location::factory()->create();

        $response = $this->postJson(
            route('api.documents.locations.store', [$document, $location])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $document
                ->locations()
                ->where('locations.id', $location->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_locations_from_document()
    {
        $document = Document::factory()->create();
        $location = Location::factory()->create();

        $response = $this->deleteJson(
            route('api.documents.locations.store', [$document, $location])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $document
                ->locations()
                ->where('locations.id', $location->id)
                ->exists()
        );
    }
}
