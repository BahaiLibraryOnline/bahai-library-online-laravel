<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Search;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
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
    public function it_gets_search_list()
    {
        $search = Search::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.search.index'));

        $response->assertOk()->assertSee($search[0]->query);
    }

    /**
     * @test
     */
    public function it_stores_the_search()
    {
        $data = Search::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.search.store'), $data);

        $this->assertDatabaseHas('searches', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_search()
    {
        $search = Search::factory()->create();

        $data = [
            'query' => $this->faker->text,
        ];

        $response = $this->putJson(route('api.search.update', $search), $data);

        $data['id'] = $search->id;

        $this->assertDatabaseHas('searches', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_search()
    {
        $search = Search::factory()->create();

        $response = $this->deleteJson(route('api.search.destroy', $search));

        $this->assertDeleted($search);

        $response->assertNoContent();
    }
}
