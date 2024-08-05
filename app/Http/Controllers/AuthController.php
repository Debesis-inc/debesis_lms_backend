<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($fields);
        $token = $user->createToken($fields['name']);
        
        return [
            'name' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();
        
        if(!$user || !Hash::check($fields['password'], $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided password is incorrect'],
            ]);
        }
        $token = $user->createToken($user->name);
        return [
            'name' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logged out'
        ];
    }



}
