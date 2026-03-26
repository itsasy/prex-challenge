<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['name', 'email']);
    }

    public function test_user_can_login_successfully()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'expires_in'
            ])
            ->assertJson([
                'expires_in' => 1800,
            ]);;
    }

    public function test_login_fails_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response
            //->assertStatus(401)
            ->assertJsonFragment([
                'message' => 'Invalid credentials'
            ]);
    }

    public function test_login_requires_email_and_password()
    {
        $response = $this->postJson('/api/login', []);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }
}
