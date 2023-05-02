<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => Role::USER
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json(['user'  => $user , 'token' => $token] , 201);
    }

    public function login(LoginRequest $request){
        $user = User::where('email' , $request->get('email'))->first();

        if (!$user || !Hash::check($request->get('password') , $user->password)){
            return response()->json(['message' => 'Bad creds'] , 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json(['user'  => $user , 'token' => $token] , 201);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
