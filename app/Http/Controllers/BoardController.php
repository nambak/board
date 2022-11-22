<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index()
    {
        return Board::all();
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string',
            'description' => 'required:string',
        ]);

        Board::create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return response('success', 201);
    }

    public function update(Board $board, Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $board->update(['title' => $request->title]);
    }

    public function delete(Board $board)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $board->delete();
    }
}
