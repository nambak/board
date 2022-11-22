<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\Comment;
use App\Models\Thread;
use App\Models\User;
use Tests\TestCase;

class CommentTest extends TestCase
{
    protected $borad;
    protected $user;
    protected $thread;
    protected $comment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->board = Board::factory()->create();
        $this->user = User::factory()->create();
        $this->thread = Thread::factory()->create([
            'board_id'  => $this->board->id,
            'writer_id' => $this->user->id,
        ]);
        $this->comment = Comment::factory()->create([
            'thread_id' => $this->thread->id,
            'writer_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function test_create_comment()
    {
        $response =
            $this->withHeaders(['Authorization' => 'Bearer ' . $this->user->access_token])
                ->postJson('/api/thread/' . $this->thread->id . '/comment', [
                    'comment' => 'comment_test',
                ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function test_update_comment()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->user->access_token])
            ->putJson('/api/comment/' . $this->comment->id, [
                'comment' => 'comment_test',
            ]);

        $response->assertSuccessful();
    }

    /** @test */
    public function test_delete_comment()
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->user->access_token])
            ->deleteJson('/api/comment/' . $this->comment->id);

        $response->assertSuccessful();
    }


}
