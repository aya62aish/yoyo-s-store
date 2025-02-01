<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpCheck extends Controller
{
    public function send(Request $request) {
        $mail = $request->validate([
            'email'=>'required|email'
        ]);
        $user = User::where('email',$mail)->first();
        if(!$user) {
            return ApiResponse::sendresponse("401","User Not Found",[]);
        }
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();
        mail::to($mail)->send(new \App\Mail\OtpCheck($otp));
        return ApiResponse::sendresponse("200","otp sent successfully",['email' => $mail]);
    }
    public function check(Request $request){
        $request->validate([
           'otp'=>'required'
        ]);
        $user = $request->user();
        if(!$user) {
            return ApiResponse::sendresponse('401', 'User not found',[]);
        }
        if($user->otp == $request['otp']){
            $user->update(['is_verified' => true]);
            return ApiResponse::sendresponse('200','OTP verified',[]);
        }
        return ApiResponse::sendresponse('401','OTP not verified',[]);
    }
}
