<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        $user->api_token = $token;
        $user->save();

        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function me(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = User::where('api_token', $token)->first();

        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users',
            'birthdate' => 'required|date',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|max:255|confirmed',
            "avatar" => "nullable|image"
        ]);

        $avatarName = null;

        if (!empty($request->avatar)) {
            $avatarName = time() . "." . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path("assets/avatars"), $avatarName);
        }

        $user = User::create([
            "first_name" => $request->firstName,
            "last_name" => $request->lastName,
            "username" => $request->username,
            "avatar" => $avatarName,
            "birthdate" => $request->birthdate,
            "password" => Hash::make($request->password),
            "email" => $request->email
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->api_token = null;
        $user->save();

        Auth::logout();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        $token = Auth::refresh();

        $user = Auth::user();
        $user->api_token = $token;
        $user->save();

        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
}