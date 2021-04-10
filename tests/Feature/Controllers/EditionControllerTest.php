<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Edition;

use App\Models\Document;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_editions()
    {
        $editions = Edition::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('editions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.editions.index')
            ->assertViewHas('editions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_edition()
    {
        $response = $this->get(route('editions.create'));

        $response->assertOk()->assertViewIs('app.editions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_edition()
    {
        $data = Edition::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('editions.store'), $data);

        $this->assertDatabaseHas('editions', $data);

        $edition = Edition::latest('id')->first();

        $response->assertRedirect(route('editions.edit', $edition));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_edition()
    {
        $edition = Edition::factory()->create();

        $response = $this->get(route('editions.show', $edition));

        $response
            ->assertOk()
            ->assertViewIs('app.editions.show')
            ->assertViewHas('edition');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_edition()
    {
        $edition = Edition::factory()->create();

        $response = $this->get(route('editions.edit', $edition));

        $response
            ->assertOk()
            ->assertViewIs('app.editions.edit')
            ->assertViewHas('edition');
    }

    /**
     * @test
     */
    public function it_updates_the_edition()
    {
        $edition = Edition::factory()->create();

        $document = Document::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'subtitle' => $this->faker->text(255),
            'title_parent' => $this->faker->text(255),
            'volume' => $this->faker->text(255),
            'page_range' => $this->faker->word(255),
            'page_total' => $this->faker->word(255),
            'publisher_name' => $this->faker->text(255),
            'publisher_city' => $this->faker->text(255),
            'date' => $this->faker->date,
            'isbn' => $this->faker->text(255),
            'document_id' => $document->id,
        ];

        $response = $this->put(route('editions.update', $edition), $data);

        $data['id'] = $edition->id;

        $this->assertDatabaseHas('editions', $data);

        $response->assertRedirect(route('editions.edit', $edition));
    }

    /**
     * @test
     */
    public function it_deletes_the_edition()
    {
        $edition = Edition::factory()->create();

        $response = $this->delete(route('editions.destroy', $edition));

        $response->assertRedirect(route('editions.index'));

        $this->assertDeleted($edition);
    }
}
