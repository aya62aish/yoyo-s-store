<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\ad;

class AdsController extends Controller
{
    public function index()
    {
      $ads = ad::paginate(10)->sortByDesc('created_at');
      $ads = $ads->values();
      if($ads->isEmpty()){
          return ApiResponse::sendresponse(200,"no ads found", []);
      }
      return ApiResponse::sendresponse(200,"ads retrieved successfully", $ads);
    }
    public function latest() {
        $ads = ad::latest()->paginate(10);
        $ads = $ads->values();
        if($ads->isEmpty()){
            return ApiResponse::sendresponse(200,"no ads found", []);
        }
        return ApiResponse::sendresponse(200,"ads retrieved successfully", $ads);
    }
    public function top()
    {
        $ads = ad::where('status', 'top')->paginate(10)->sortByDesc('created_at');
        $ads = $ads->values();

        if($ads->isEmpty()){
            return ApiResponse::sendresponse(200,"no ads found", []);
        }
        return ApiResponse::sendresponse(200,"ads retrieved successfully", $ads);
    }
}