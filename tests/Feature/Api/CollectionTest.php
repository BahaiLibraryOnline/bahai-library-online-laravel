<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Collection;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollectionTest extends TestCase
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
    public function it_gets_collections_list()
    {
        $collections = Collection::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.collections.index'));

        $response->assertOk()->assertSee($collections[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_collection()
    {
        $data = Collection::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.collections.store'), $data);

        $this->assertDatabaseHas('collections', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_collection()
    {
        $collection = Collection::factory()->create();

        $data = [
            'slug' => $this->faker->text(255),
            'name' => $this->faker->text,
            'shortname' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.collections.update', $collection),
            $data
        );

        $data['id'] = $collection->id;

        $this->assertDatabaseHas('collections', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_collection()
    {
        $collection = Collection::factory()->create();

        $response = $this->deleteJson(
            route('api.collections.destroy', $collection)
        );

        $this->assertDeleted($collection);

        $response->assertNoContent();
    }
}
