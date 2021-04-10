<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDocumentsTest extends TestCase
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
    public function it_gets_user_documents()
    {
        $user = User::factory()->create();
        $document = Document::factory()->create();

        $user->documents()->attach($document);

        $response = $this->getJson(route('api.users.documents.index', $user));

        $response->assertOk()->assertSee($document->slug);
    }

    /**
     * @test
     */
    public function it_can_attach_documents_to_user()
    {
        $user = User::factory()->create();
        $document = Document::factory()->create();

        $response = $this->postJson(
            route('api.users.documents.store', [$user, $document])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $user
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_documents_from_user()
    {
        $user = User::factory()->create();
        $document = Document::factory()->create();

        $response = $this->deleteJson(
            route('api.users.documents.store', [$user, $document])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $user
                ->documents()
                ->where('documents.id', $document->id)
                ->exists()
        );
    }
}
