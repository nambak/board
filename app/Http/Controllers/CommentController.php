<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Thread;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Thread $thread, Request $request) {
        $request->validate([
            'comment' => 'required',
        ]);

        $thread->comments()->create([
            'content'   => $request->comment,
            'writer_id' => auth()->user()->id,
        ]);

        return response('success', 201);
    }

    public function update(Comment $comment, Request $request)
    {
        if ($comment->writer_id != auth()->user()->id) {
            abort(403);
        }

        $comment->update(['content' => $request->comment]);
    }

    public function delete(Comment $comment) {
        if ($comment->writer_id != auth()->user()->id) {
            abort(403);
        }

        $comment->delete();
    }
}
