<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Edition;
use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentEditionsTest extends TestCase
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
    public function it_gets_document_editions()
    {
        $document = Document::factory()->create();
        $editions = Edition::factory()
            ->count(2)
            ->create([
                'document_id' => $document->id,
            ]);

        $response = $this->getJson(
            route('api.documents.editions.index', $document)
        );

        $response->assertOk()->assertSee($editions[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_document_editions()
    {
        $document = Document::factory()->create();
        $data = Edition::factory()
            ->make([
                'document_id' => $document->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.documents.editions.store', $document),
            $data
        );

        unset($data['date']);
        $this->assertDatabaseHas('editions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $edition = Edition::latest('id')->first();

        $this->assertEquals($document->id, $edition->document_id);
    }
}
