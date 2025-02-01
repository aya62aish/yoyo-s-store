<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\OtpCheck;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     * register form using email, pass and phone then send otp
     */
    public function Register(RegisterRequest $request) {
        $data = $request->validated();
        $otp = rand(100000, 999999);
      $x = User::where('email' , $data['email'])->get();
      if(count($x)){
      return ApiResponse::sendresponse(409, 'email already found', []);
      }
        $user = User::create(
            [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => Hash::make ($data['password']),
                'otp' => $otp,
                'is_verified' => '0',
                'fcm_token' => $data['fcm_token'],
            ]
        );
        Mail::to($data['email'])->send(new OtpCheck($otp));
        if($user) {
            $data['token'] = $user->createToken('register')->plainTextToken;
            $data_returned['name'] = $user->name;
            $data_returned['email'] = $user->email;
            $data_returned['phone'] = $user->phone;
            $data_returned['is_verified'] = $user->is_verified;
            $data_returned['token'] = $data['token'];
            return ApiResponse::sendresponse(201, 'created successfully', $data_returned);
        }
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * login form by email and password
     *
     */
    public function login(LoginRequest $request){
        $data = $request->validated();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            User::updated(
                [
                    'fcm_token' => $data['fcm_token'],
                ]
            );
            $user = Auth::user();
            $data['token'] = $user->createToken('login')->plainTextToken;
            $data_returned['name'] = $user->name;
            $data_returned['email'] = $user->email;
            $data_returned['is_verified'] = $user->is_verified;
            $data_returned['token'] = $data['token'];
            return ApiResponse::sendresponse(200, 'login successfully', $data_returned);
        }
        else {
            return ApiResponse::sendresponse(401, 'login failed',[]);
        }
    }
   /**
     * edit profile function to edit email and name
     */
    public function editProfile(Request $request) {
        $data = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
            ]
        );
        $user = auth()->user();
        $user = user::find($user->id);
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();
        return ApiResponse::sendresponse(201, 'updated successfully', $user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * logout function by deleting token
     */
    public function logout(Request $request) {
        // need to logout by token
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::sendresponse(200, 'logout successfully',[]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * forget api to send otp to the email
     */
    public function forgot(Request $request) {
      $validator =  Validator::make($request->all(),[
            'email' => 'required|email'
        ]);
      if($validator->fails()) {
          return ApiResponse::sendresponse(422, 'validation error', $validator->errors());
      }
      $email = $request->email;
        $user = User::where('email', $email)->first();
        if($user) {
            $otp = rand(100000, 999999);
            //check the token
          $token =  $user->createToken('login')->plainTextToken;
           $user->otp = $otp;
             $user->save();
            mail::to($user->email)->send(new OtpCheck($otp));
            //send otp
        return ApiResponse::sendresponse(200, 'otp sent successfully', ['token' => $token]);
        }
        return ApiResponse::sendresponse(422, 'email not found',[]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * reset pass api to change pass depends on email and token
     */
    public function reset(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'password' => 'required|confirmed',
        ]);
        if($validator->fails()) {
            return ApiResponse::sendresponse(422, 'validation error', $validator->errors());
        }
        $user = $request->user();
        if (!$user) {
            return ApiResponse::sendresponse(401, 'Unauthorized', []);
        }
        $user->update(['password' => Hash::make($request['password'])]);
        return ApiResponse::sendresponse(200, 'password reset successfully',[]);
    }
}
