<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $password = Hash::make($request->password);

        $user = User::where('admin', 1)
                    ->where('email', $request->email)
                    ->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'your credential does not match']);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $cookie = cookie('jwt', $token, 60*24);
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response()->json($response)->withCookie($cookie);

    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'logged out']);
    }
}
