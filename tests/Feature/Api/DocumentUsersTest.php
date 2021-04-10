<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Document;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentUsersTest extends TestCase
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
    public function it_gets_document_users()
    {
        $document = Document::factory()->create();
        $user = User::factory()->create();

        $document->users()->attach($user);

        $response = $this->getJson(
            route('api.documents.users.index', $document)
        );

        $response->assertOk()->assertSee($user->name);
    }

    /**
     * @test
     */
    public function it_can_attach_users_to_document()
    {
        $document = Document::factory()->create();
        $user = User::factory()->create();

        $response = $this->postJson(
            route('api.documents.users.store', [$document, $user])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $document
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_users_from_document()
    {
        $document = Document::factory()->create();
        $user = User::factory()->create();

        $response = $this->deleteJson(
            route('api.documents.users.store', [$document, $user])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $document
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }
}
