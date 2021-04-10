<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Document;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentControllerTest extends TestCase
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
    public function it_displays_index_view_with_documents()
    {
        $documents = Document::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('documents.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.documents.index')
            ->assertViewHas('documents');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_document()
    {
        $response = $this->get(route('documents.create'));

        $response->assertOk()->assertViewIs('app.documents.create');
    }

    /**
     * @test
     */
    public function it_stores_the_document()
    {
        $data = Document::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('documents.store'), $data);

        $this->assertDatabaseHas('documents', $data);

        $document = Document::latest('id')->first();

        $response->assertRedirect(route('documents.edit', $document));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_document()
    {
        $document = Document::factory()->create();

        $response = $this->get(route('documents.show', $document));

        $response
            ->assertOk()
            ->assertViewIs('app.documents.show')
            ->assertViewHas('document');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_document()
    {
        $document = Document::factory()->create();

        $response = $this->get(route('documents.edit', $document));

        $response
            ->assertOk()
            ->assertViewIs('app.documents.edit')
            ->assertViewHas('document');
    }

    /**
     * @test
     */
    public function it_updates_the_document()
    {
        $document = Document::factory()->create();

        $data = [
            'is_pdf' => $this->faker->boolean,
            'is_audio' => $this->faker->boolean,
            'is_image' => $this->faker->boolean,
            'is_video' => $this->faker->boolean,
            'is_html' => $this->faker->boolean,
            'file_url' => $this->faker->text(255),
            'blurb' => $this->faker->text,
            'content_html' => $this->faker->text,
            'content_size' => $this->faker->word,
            'edit_quality' => 'high',
            'formatting_quality' => 'high',
            'publication_permission' => 'author',
            'notes' => $this->faker->text,
            'input_type' => 'scanned',
            'input_by' => $this->faker->word,
            'input_date' => $this->faker->date,
            'proof_by' => $this->faker->word,
            'proof_date' => $this->faker->date,
            'format_by' => $this->faker->word,
            'format_date' => $this->faker->date,
            'post_by' => $this->faker->word,
            'post_date' => $this->faker->date,
            'publication_approval' => 'approved',
            'views' => 0,
        ];

        $response = $this->put(route('documents.update', $document), $data);

        $data['id'] = $document->id;

        $this->assertDatabaseHas('documents', $data);

        $response->assertRedirect(route('documents.edit', $document));
    }

    /**
     * @test
     */
    public function it_deletes_the_document()
    {
        $document = Document::factory()->create();

        $response = $this->delete(route('documents.destroy', $document));

        $response->assertRedirect(route('documents.index'));

        $this->assertSoftDeleted($document);
    }
}
