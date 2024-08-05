<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id', 'name', 'email',
                 ]);
    }

    public function test_can_list_users()
    {
        $user = User::factory()->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'name' => $user->name,
                 ]);
    }
}
