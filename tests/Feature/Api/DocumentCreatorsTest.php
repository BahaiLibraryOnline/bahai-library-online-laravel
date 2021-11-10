<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Creator;
use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentCreatorsTest extends TestCase
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
    public function it_gets_document_creators()
    {
        $document = Document::factory()->create();
        $creator = Creator::factory()->create();

        $document->creators()->attach($creator);

        $response = $this->getJson(
            route('api.documents.creators.index', $document)
        );

        $response->assertOk()->assertSee($creator->first_names);
    }

    /**
     * @test
     */
    public function it_can_attach_creators_to_document()
    {
        $document = Document::factory()->create();
        $creator = Creator::factory()->create();

        $response = $this->postJson(
            route('api.documents.creators.store', [$document, $creator])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $document
                ->creators()
                ->where('creators.id', $creator->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_creators_from_document()
    {
        $document = Document::factory()->create();
        $creator = Creator::factory()->create();

        $response = $this->deleteJson(
            route('api.documents.creators.store', [$document, $creator])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $document
                ->creators()
                ->where('creators.id', $creator->id)
                ->exists()
        );
    }
}
