<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            return response()->json(['token' => $user->createToken('WebApp')->accessToken], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public function reset(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->update($request->all());
        return;
    }
    public function user()
    {
        $user = Auth::user();
        return response()->json(['user' => $user], 200);
    }
    public function logout()
    {
        Auth::user()->tokens->each(function ($token) {
            $token->delete();
        });
        return response()->json('Logged out soccessfully', 200);
    }
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json(['message' => 'Пользователь успешно удалён'], 200);
        }
    }
}
