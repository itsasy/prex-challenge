<?php

namespace Tests\Feature\Favorite;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class FavoriteApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Passport::actingAs($this->user);
    }

    public function test_user_can_save_a_gif_as_favorite()
    {
        $response = $this->postJson('/api/favorites', [
            'gif_id' => 'abc123xyz',
            'alias' => 'Mi gato favorito'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id', 'gif_id', 'user_id', 'alias'
            ]);
    }

    public function test_user_can_list_his_favorites()
    {
        $this->postJson('/api/favorites', ['gif_id' => 'cat1', 'alias' => 'Gato 1']);
        $this->postJson('/api/favorites', ['gif_id' => 'cat2', 'alias' => 'Gato 2']);

        $response = $this->getJson('/api/favorites');

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    public function test_user_can_delete_a_favorite()
    {
        $store = $this->postJson('/api/favorites', ['gif_id' => 'to-delete']);

        $favoriteId = $store['id'];

        $response = $this->deleteJson("/api/favorites/{$favoriteId}");

        $response->assertStatus(200);
    }
}
