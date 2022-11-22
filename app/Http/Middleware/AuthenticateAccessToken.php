<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;

class AuthenticateAccessToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response('required access_token', 401);
        }

        $user = User::where('access_token', $token)->first();

        if (is_null($user)) {
            return response('not exist user', 401);
        }

        Auth::login($user);

        return $next($request);
    }
}
