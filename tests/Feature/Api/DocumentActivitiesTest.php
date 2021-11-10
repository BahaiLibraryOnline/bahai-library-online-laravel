<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Document;
use App\Models\Activity;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentActivitiesTest extends TestCase
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
    public function it_gets_document_activities()
    {
        $document = Document::factory()->create();
        $activities = Activity::factory()
            ->count(2)
            ->create([
                'document_id' => $document->id,
            ]);

        $response = $this->getJson(
            route('api.documents.activities.index', $document)
        );

        $response->assertOk()->assertSee($activities[0]->comment);
    }

    /**
     * @test
     */
    public function it_stores_the_document_activities()
    {
        $document = Document::factory()->create();
        $data = Activity::factory()
            ->make([
                'document_id' => $document->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.documents.activities.store', $document),
            $data
        );

        $this->assertDatabaseHas('activities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $activity = Activity::latest('id')->first();

        $this->assertEquals($document->id, $activity->document_id);
    }
}
