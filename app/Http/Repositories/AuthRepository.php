<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;




class AuthRepository implements AuthInterface
{
    private $userModel;
    use ApiResponseTrait;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->apiresponse(401, null, $validate->errors(), null);
        }
        $user = $this->userModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $tenant  = Tenant::first();
        $tenant->users()->attach($user->id);
        JWTAuth::login($user);

        return $this->apiresponse(200, 'User Registered successfully', null, $user);

    }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ]);
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validate->fails()) {
            return $this->apiresponse(422, null, $validate->errors(), null);
        }
        if (!$token = JWTAuth::attempt($validate->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully logged out']);
    }





}


