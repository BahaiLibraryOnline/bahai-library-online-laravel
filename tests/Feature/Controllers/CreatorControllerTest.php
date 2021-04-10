<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Creator;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatorControllerTest extends TestCase
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
    public function it_displays_index_view_with_creators()
    {
        $creators = Creator::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('creators.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.creators.index')
            ->assertViewHas('creators');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_creator()
    {
        $response = $this->get(route('creators.create'));

        $response->assertOk()->assertViewIs('app.creators.create');
    }

    /**
     * @test
     */
    public function it_stores_the_creator()
    {
        $data = Creator::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('creators.store'), $data);

        $this->assertDatabaseHas('creators', $data);

        $creator = Creator::latest('id')->first();

        $response->assertRedirect(route('creators.edit', $creator));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_creator()
    {
        $creator = Creator::factory()->create();

        $response = $this->get(route('creators.show', $creator));

        $response
            ->assertOk()
            ->assertViewIs('app.creators.show')
            ->assertViewHas('creator');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_creator()
    {
        $creator = Creator::factory()->create();

        $response = $this->get(route('creators.edit', $creator));

        $response
            ->assertOk()
            ->assertViewIs('app.creators.edit')
            ->assertViewHas('creator');
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

        $response = $this->put(route('creators.update', $creator), $data);

        $data['id'] = $creator->id;

        $this->assertDatabaseHas('creators', $data);

        $response->assertRedirect(route('creators.edit', $creator));
    }

    /**
     * @test
     */
    public function it_deletes_the_creator()
    {
        $creator = Creator::factory()->create();

        $response = $this->delete(route('creators.destroy', $creator));

        $response->assertRedirect(route('creators.index'));

        $this->assertDeleted($creator);
    }
}
