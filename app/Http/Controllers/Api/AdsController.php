<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\ad;

class AdsController extends Controller
{
    public function index()
    {
      $ads = ad::all()->sortByDesc('created_at')->paginate(10);
      $ads = $ads->values();
      if($ads->isEmpty()){
          return ApiResponse::sendresponse(200,"no ads found", []);
      }
      return ApiResponse::sendresponse(200,"ads retrieved successfully", $ads);
    }
    public function latest() {
        $ads = ad::latest()->take(10)->get();
        $ads = $ads->values();
        if($ads->isEmpty()){
            return ApiResponse::sendresponse(200,"no ads found", []);
        }
        return ApiResponse::sendresponse(200,"ads retrieved successfully", $ads);
    }
    public function top()
    {
        $ads = ad::where('status', 'top')->get();
        $ads = $ads->values();
//        ad::create(
//            [
//                'title' => 'title',
//                'description' => 'description',
//                'image' => 'image',
//                'status' => 'top',
//                'member_id' => '1',
//            ]
//        );
        if($ads->isEmpty()){
            return ApiResponse::sendresponse(200,"no ads found", []);
        }
        return ApiResponse::sendresponse(200,"ads retrieved successfully", $ads);
    }
}