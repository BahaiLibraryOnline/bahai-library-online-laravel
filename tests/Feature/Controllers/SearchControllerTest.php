<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Search;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_search()
    {
        $search = Search::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('search.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.search.index')
            ->assertViewHas('search');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_search()
    {
        $response = $this->get(route('search.create'));

        $response->assertOk()->assertViewIs('app.search.create');
    }

    /**
     * @test
     */
    public function it_stores_the_search()
    {
        $data = Search::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('search.store'), $data);

        $this->assertDatabaseHas('searches', $data);

        $search = Search::latest('id')->first();

        $response->assertRedirect(route('search.edit', $search));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_search()
    {
        $search = Search::factory()->create();

        $response = $this->get(route('search.show', $search));

        $response
            ->assertOk()
            ->assertViewIs('app.search.show')
            ->assertViewHas('search');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_search()
    {
        $search = Search::factory()->create();

        $response = $this->get(route('search.edit', $search));

        $response
            ->assertOk()
            ->assertViewIs('app.search.edit')
            ->assertViewHas('search');
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

        $response = $this->put(route('search.update', $search), $data);

        $data['id'] = $search->id;

        $this->assertDatabaseHas('searches', $data);

        $response->assertRedirect(route('search.edit', $search));
    }

    /**
     * @test
     */
    public function it_deletes_the_search()
    {
        $search = Search::factory()->create();

        $response = $this->delete(route('search.destroy', $search));

        $response->assertRedirect(route('search.index'));

        $this->assertDeleted($search);
    }
}
