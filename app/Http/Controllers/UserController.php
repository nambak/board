<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => bcrypt($request->password),
            'access_token' => bin2hex(random_bytes(32)),
        ]);

        return response('success', 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where([
            ['email', $request->email],
        ])->first();

        if (is_null($user)) {
            return response('not exist user', 401);
        }

        return response()->json([
            'access_token' => $user->access_token,
        ]);
    }
}
