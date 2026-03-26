<?php

namespace Tests\Feature\Gifs;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GifApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Passport::actingAs($this->user);
    }

    public function test_search_gifs_with_valid_query()
    {
        $response = $this->getJson('/api/gifs/search?query=cat&limit=5');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'total',
            ])
            ->assertJsonCount(5, 'data');
    }

    public function test_search_gifs_requires_query()
    {
        $response = $this->getJson('/api/gifs/search');

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['query']);
    }

    public function test_get_gif_by_id_returns_single_gif()
    {
        $searchGifs = $this->getJson('/api/gifs/search?query=cat&limit=5');

        $validGifId = $searchGifs['data'][0]['id'];

        $response = $this->getJson("/api/gifs/{$validGifId}");

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'title',
                'url',
                'preview_url',
            ]);
    }

    public function test_get_gif_by_id_returns_empty_when_not_found()
    {
        $response = $this->getJson('/api/gifs/invalid-id-999999');

        $response->assertJsonStructure([]);
    }
}
