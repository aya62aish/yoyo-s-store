<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Register(RegisterRequest $request) {
        $data = $request->validated();
        $user = User::create(
            [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'password' => Hash::make ($data['password']),
                // otp trying
                'otp' => '123456789',
                'is_verified' => '0',
            ]
        );

        if($user) {
            $data['token'] = $user->createToken('register')->plainTextToken;
            $data_returned['name'] = $user->name;
            $data_returned['phone'] = $user->phone;
            $data_returned['is_verified'] = $user->is_verified;
            $data_returned['token'] = $data['token'];
            return ApiResponse::sendresponse(201, 'created successfully', $data_returned);
        }
    }
    public function login(LoginRequest $request){
        $data = $request->validated();
        if (Auth::attempt(['phone' => $data['phone'], 'password' => $data['password']])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('login')->plainTextToken;
            $data_returned['name'] = $user->name;
            $data_returned['phone'] = $user->phone;
            $data_returned['is_verified'] = $user->is_verified;
            $data_returned['token'] = $data['token'];
            return ApiResponse::sendresponse(200, 'login successfully', $data_returned);
        }
        else {
            return ApiResponse::sendresponse(401, 'login failed',[]);
        }
    }
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::sendresponse(200, 'logout successfully',[]);
    }
}