<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;

use App\Models\Edition;

use App\Models\Document;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditionTest extends TestCase
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
    public function it_gets_editions_list()
    {
        $editions = Edition::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.editions.index'));

        $response->assertOk()->assertSee($editions[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_edition()
    {
        $date = new Carbon($this->faker->date());

        $data = Edition::factory()
            ->make()
            ->toArray();
        $data['date'] = $date->format('Y-m-d H:i:s');

        $response = $this->postJson(route('api.editions.store'), $data);

        $this->assertDatabaseHas('editions', $data);

        $response->assertStatus(201)->assertJsonFragment(['date' => $date] + $data);
    }

    /**
     * @test
     */
    public function it_updates_the_edition()
    {
        $edition = Edition::factory()->create();

        $document = Document::factory()->create();

        $date = new Carbon($this->faker->date());

        $data = [
            'title' => $this->faker->sentence(10),
            'subtitle' => $this->faker->text(255),
            'title_parent' => $this->faker->text(255),
            'volume' => $this->faker->text(255),
            'page_range' => $this->faker->word(255),
            'page_total' => $this->faker->word(255),
            'publisher_name' => $this->faker->text(255),
            'publisher_city' => $this->faker->text(255),
            'date' => $date->format('Y-m-d H:i:s'),
            'isbn' => $this->faker->text(255),
            'document_id' => $document->id,
        ];

        $response = $this->putJson(
            route('api.editions.update', $edition),
            $data
        );

        $data['id'] = $edition->id;

        $this->assertDatabaseHas('editions', $data);

        $response->assertOk()->assertJsonFragment(['date' => $date] + $data);
    }

    /**
     * @test
     */
    public function it_deletes_the_edition()
    {
        $edition = Edition::factory()->create();

        $response = $this->deleteJson(route('api.editions.destroy', $edition));

        $this->assertDeleted($edition);

        $response->assertNoContent();
    }
}
