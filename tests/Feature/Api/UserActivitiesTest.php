<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Activity;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserActivitiesTest extends TestCase
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
    public function it_gets_user_activities()
    {
        $user = User::factory()->create();
        $activities = Activity::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.activities.index', $user));

        $response->assertOk()->assertSee($activities[0]->comment);
    }

    /**
     * @test
     */
    public function it_stores_the_user_activities()
    {
        $user = User::factory()->create();
        $data = Activity::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.activities.store', $user),
            $data
        );

        $this->assertDatabaseHas('activities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $activity = Activity::latest('id')->first();

        $this->assertEquals($user->id, $activity->user_id);
    }
}
