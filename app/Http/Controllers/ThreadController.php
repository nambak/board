<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index(Board $board)
    {
        return $board->threads()->with('comments')->paginate(10);
    }

    public function store(Board $board, Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'text' => 'required',
        ]);

        $board->threads()->create([
            'title'     => $request->title,
            'content'   => $request->text,
            'writer_id' => auth()->user()->id,
        ]);

        return response('success', 201);
    }

    public function update(Thread $thread, Request $request)
    {
        if ($thread->writer_id != auth()->user()->id) {
            abort(403);
        }

        $thread->update($request->all());
    }

    public function delete(Thread $thread)
    {
        if ($thread->writer_id != auth()->user()->id) {
            abort(403);
        }

        $thread->delete();
    }
}
