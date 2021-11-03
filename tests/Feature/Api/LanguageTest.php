<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Language;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageTest extends TestCase
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
    public function it_gets_languages_list()
    {
        $languages = Language::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.languages.index'));

        $response->assertOk()->assertSee($languages[0]->language);
    }

    /**
     * @test
     */
    public function it_stores_the_language()
    {
        $data = Language::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.languages.store'), $data);

        $this->assertDatabaseHas('languages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_language()
    {
        $language = Language::factory()->create();

        $data = [
            'language' => $this->faker->text(255),
            'language_tag' => $this->faker->word(255),
        ];

        $response = $this->putJson(
            route('api.languages.update', $language),
            $data
        );

        $data['id'] = $language->id;

        $this->assertDatabaseHas('languages', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_language()
    {
        $language = Language::factory()->create();

        $response = $this->deleteJson(
            route('api.languages.destroy', $language)
        );

        $this->assertDeleted($language);

        $response->assertNoContent();
    }
}
