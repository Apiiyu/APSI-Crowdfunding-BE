<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
    * Create user
    *
    * @param  [string] name
    * @param  [string] email
    * @param  [string] password
    * @param  [string] password_confirmation
    * @return [string] message
    */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
        ]);

        // ? Check if the avatar is provided
        $avatar = null;

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar')->store('uploads/avatars', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $avatar,
        ]);

        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return ResponseFormatter::success([
                'accessToken' => $token,
                'token_type' => 'Bearer',
            ], 'User registered');
        }
        else{
            return ResponseFormatter::error([
                'message' => 'Failed to register user'
            ], 'Register Failed', 500);
        }
    }

    /**
    * Login user and create token
    *
    * @param  [string] email
    * @param  [string] password
    * @param  [boolean] remember_me
    */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return ResponseFormatter::success([
            'accessToken' => $token,
            'token_type' => 'Bearer',
        ], 'Authenticated');
    }
}
