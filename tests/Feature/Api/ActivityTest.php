<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Activity;

use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
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
    public function it_gets_activities_list()
    {
        $activities = Activity::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.activities.index'));

        $response->assertOk()->assertSee($activities[0]->comment);
    }

    /**
     * @test
     */
    public function it_stores_the_activity()
    {
        $data = Activity::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.activities.store'), $data);

        $this->assertDatabaseHas('activities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_activity()
    {
        $activity = Activity::factory()->create();

        $document = Document::factory()->create();
        $user = User::factory()->create();

        $data = [
            'activity_type' => 'created',
            'comment' => $this->faker->text(255),
            'document_id' => $document->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.activities.update', $activity),
            $data
        );

        $data['id'] = $activity->id;

        $this->assertDatabaseHas('activities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_activity()
    {
        $activity = Activity::factory()->create();

        $response = $this->deleteJson(
            route('api.activities.destroy', $activity)
        );

        $this->assertDeleted($activity);

        $response->assertNoContent();
    }
}
