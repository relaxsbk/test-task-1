<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {

        $login = $request->input('login');
        $password = $request->input('password');

        if (!Auth::guard('web')->attempt(['login' => $login, 'password' => $password])) {
            return response()->json([
                'message' => 'login or password fail'
            ], 401);
        }

        $user = Auth::guard('web')->user();

        $token = $user->createToken('AuthToken');

        $user->update(['api_token' => $token]);

        return ['token' => $token->plainTextToken];

    }

    public function register(RegisterRequest $request)
    {
        User::query()->create($request->validated());

       return response()->json([
           "message" => "User created"
       ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'User logout'
        ]);
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        return new UserResource($user);
    }
}
