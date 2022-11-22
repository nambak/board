<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function test_register_user()
    {
        $user = User::factory()->make();

        $response = $this->postJson('/api/user/register', [
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => '12345678',
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function test_login_user()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/user/login', [
            'email'        => $user->email,
            'password'     => $user->password,
        ]);

        $response->assertSuccessful()->assertJson([
            'access_token' => $user->access_token,
        ]);
    }
}
