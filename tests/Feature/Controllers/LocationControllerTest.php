<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Location;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationControllerTest extends TestCase
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
    public function it_displays_index_view_with_locations()
    {
        $locations = Location::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('locations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.locations.index')
            ->assertViewHas('locations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_location()
    {
        $response = $this->get(route('locations.create'));

        $response->assertOk()->assertViewIs('app.locations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_location()
    {
        $data = Location::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('locations.store'), $data);

        $this->assertDatabaseHas('locations', $data);

        $location = Location::latest('id')->first();

        $response->assertRedirect(route('locations.edit', $location));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_location()
    {
        $location = Location::factory()->create();

        $response = $this->get(route('locations.show', $location));

        $response
            ->assertOk()
            ->assertViewIs('app.locations.show')
            ->assertViewHas('location');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_location()
    {
        $location = Location::factory()->create();

        $response = $this->get(route('locations.edit', $location));

        $response
            ->assertOk()
            ->assertViewIs('app.locations.edit')
            ->assertViewHas('location');
    }

    /**
     * @test
     */
    public function it_updates_the_location()
    {
        $location = Location::factory()->create();

        $data = [
            'continent' => $this->faker->text(255),
            'country' => $this->faker->country,
            'locality' => $this->faker->text(255),
        ];

        $response = $this->put(route('locations.update', $location), $data);

        $data['id'] = $location->id;

        $this->assertDatabaseHas('locations', $data);

        $response->assertRedirect(route('locations.edit', $location));
    }

    /**
     * @test
     */
    public function it_deletes_the_location()
    {
        $location = Location::factory()->create();

        $response = $this->delete(route('locations.destroy', $location));

        $response->assertRedirect(route('locations.index'));

        $this->assertDeleted($location);
    }
}
