<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

    }


    public function update(UpdateUserRequest $request , User $user){
        $user->update($request->validated());
        return response()->json(['message' => 'User updated successfully!' , 'user' => UserResource::make($user)]);
    }
}
