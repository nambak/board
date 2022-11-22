<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/boards', [BoardController::class, 'index']);
Route::get('/board/{board}/threads', [ThreadController::class, 'index']);
Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);

Route::middleware('auth.api')->group(function () {
    Route::post('/board', [BoardController::class, 'store']);
    Route::put('/board/{board}', [BoardController::class, 'update']);
    Route::delete('/board/{board}', [BoardController::class, 'delete']);

    Route::post('/board/{board}/thread', [ThreadController::class, 'store']);
    Route::put('/thread/{thread}', [ThreadController::class, 'update']);
    Route::delete('/thread/{thread}', [ThreadController::class, 'delete']);

    Route::post('/thread/{thread}/comment', [CommentController::class, 'store']);
    Route::put('/comment/{comment}', [CommentController::class, 'update']);
    Route::delete('/comment/{comment}', [CommentController::class, 'delete']);
});

