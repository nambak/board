<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\Thread;
use App\Models\User;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    protected $borad;
    protected $user;
    protected $baseUrl;

    protected function setUp(): void
    {
        parent::setUp();

        $this->board = Board::factory()->create();
        $this->baseUrl = '/api/board/' . $this->board->id;
        $this->user = User::factory()->create();
        $this->thread = Thread::factory()->create([
            'board_id' => $this->board->id,
            'writer_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function test_get_threads()
    {
        $response = $this->getJson($this->baseUrl . '/threads');

        $response->assertSuccessful();
    }

    /** @test */
    public function test_create_thread()
    {
        $response =
            $this->withHeaders(['Authorization' => 'Bearer ' . $this->user->access_token])
                ->postJson($this->baseUrl . '/thread', [
                    'title' => 'test',
                    'text'  => 'test',
                ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function test_update_thread()
    {
        $response =
            $this->withHeaders(['Authorization' => 'Bearer ' . $this->user->access_token])
                ->putJson('/api/thread/' . $this->thread->id, [
                    'title' => 'test title',
                ]);
        $response->assertSuccessful();
    }

    /** @test */
    public function test_delete_thread()
    {
        $response =
            $this->withHeaders(['Authorization' => 'Bearer ' . $this->user->access_token])
                ->deleteJson('/api/thread/' . $this->thread->id);
        $response->assertSuccessful();
    }
}
