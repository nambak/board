<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class BoardTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'role' => 'admin',
        ]);
    }

    /** @test */
    public function test_get_boards()
    {
        $response = $this->getJson('/api/boards');

        $response->assertSuccessful();
    }

    /** @test */
    public function test_create_board()
    {
        $response =
            $this->withHeaders(['Authorization' => 'Bearer ' . $this->user->access_token])
                ->postJson('/api/board/', [
                    'title'       => 'test',
                    'description' => 'test',
                ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function test_update_board()
    {
        $response =
            $this->withHeaders(['Authorization' => 'Bearer ' . $this->user->access_token])
                ->putJson('/api/board/1', [
                    'title' => 'test title',
                ]);

        $response->assertSuccessful();
    }

    /** @test */
    public function test_delete_board()
    {
        $response =
            $this->withHeaders(['Authorization' => 'Bearer ' . $this->user->access_token])
                ->deleteJson('/api/board/1');

        $response->assertSuccessful();
    }
}
