<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Creator;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatorTest extends TestCase
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
    public function it_gets_creators_list()
    {
        $creators = Creator::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.creators.index'));

        $response->assertOk()->assertSee($creators[0]->first_names);
    }

    /**
     * @test
     */
    public function it_stores_the_creator()
    {
        $data = Creator::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.creators.store'), $data);

        $this->assertDatabaseHas('creators', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_creator()
    {
        $creator = Creator::factory()->create();

        $data = [
            'first_names' => $this->faker->text(255),
            'last_names' => $this->faker->text(255),
            'author' => $this->faker->boolean,
            'editor' => $this->faker->boolean,
            'translator' => $this->faker->boolean,
            'compiler' => $this->faker->boolean,
        ];

        $response = $this->putJson(
            route('api.creators.update', $creator),
            $data
        );

        $data['id'] = $creator->id;

        $this->assertDatabaseHas('creators', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_creator()
    {
        $creator = Creator::factory()->create();

        $response = $this->deleteJson(route('api.creators.destroy', $creator));

        $this->assertDeleted($creator);

        $response->assertNoContent();
    }
}
