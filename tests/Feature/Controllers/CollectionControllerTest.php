<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Collection;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollectionControllerTest extends TestCase
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
    public function it_displays_index_view_with_collections()
    {
        $collections = Collection::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('collections.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.collections.index')
            ->assertViewHas('collections');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_collection()
    {
        $response = $this->get(route('collections.create'));

        $response->assertOk()->assertViewIs('app.collections.create');
    }

    /**
     * @test
     */
    public function it_stores_the_collection()
    {
        $data = Collection::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('collections.store'), $data);

        $this->assertDatabaseHas('collections', $data);

        $collection = Collection::latest('id')->first();

        $response->assertRedirect(route('collections.edit', $collection));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_collection()
    {
        $collection = Collection::factory()->create();

        $response = $this->get(route('collections.show', $collection));

        $response
            ->assertOk()
            ->assertViewIs('app.collections.show')
            ->assertViewHas('collection');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_collection()
    {
        $collection = Collection::factory()->create();

        $response = $this->get(route('collections.edit', $collection));

        $response
            ->assertOk()
            ->assertViewIs('app.collections.edit')
            ->assertViewHas('collection');
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

        $response = $this->put(route('collections.update', $collection), $data);

        $data['id'] = $collection->id;

        $this->assertDatabaseHas('collections', $data);

        $response->assertRedirect(route('collections.edit', $collection));
    }

    /**
     * @test
     */
    public function it_deletes_the_collection()
    {
        $collection = Collection::factory()->create();

        $response = $this->delete(route('collections.destroy', $collection));

        $response->assertRedirect(route('collections.index'));

        $this->assertDeleted($collection);
    }
}
