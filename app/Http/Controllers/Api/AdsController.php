<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdsResource;
use App\Models\ad;
use App\Models\banners;
use App\Models\review;
use Illuminate\Pagination\Paginator;
use App\Models\member;


class AdsController extends Controller
{
    public function index()
    {
        $ads = ad::with('member')->orderByRaw("CASE WHEN status = 'top' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($ads as $ad) {
            $rate = review::where('user_id', $ad->member->id)->avg('rating');
            $ad->member = [
                'id' => $ad->member->id,
                'name' => $ad->member->name,
                'location' => $ad->member->location,
                'phone' => $ad->member->phone,
                'whatsapp' => $ad->member->whatsapp,
                'rating' => $rate?: 0,
                'review numbers' => review::where('user_id', $ad->member->id)->count(),
            ];
        }

        if ($ads->isEmpty()) {
            return ApiResponse::sendresponse(200, "no ads found", []);
        }
        $paginationInfo = [
            'total' => $ads->total(),
            'per_page' => $ads->perPage(),
            'current_page' => $ads->currentPage(),
            'last_page' => $ads->lastPage(),
            'next_page_url' => $ads->nextPageUrl(),
            'prev_page_url' => $ads->previousPageUrl(),
        ];

        $data = [
            'ads' => AdsResource::collection($ads),
            'pagination' => $paginationInfo,
        ];
        return ApiResponse::sendresponse(200, "ads retrieved successfully", $data);
    }

    public function banners()
    {
        $ads = banners::get()->sortByDesc('created_at');
        if ($ads->isEmpty()) {
            return ApiResponse::sendresponse(200, "no ads found", []);
        }
        return ApiResponse::sendresponse(200, "ads retrieved successfully", $ads);
    }
//    public function latest() {
//        $ads = ad::orderByRaw("CASE WHEN status = 'top' THEN 0 ELSE 1 END")
//            ->orderBy('created_at', 'desc')
//            ->take(10);
//        if($ads->isEmpty()){
//            return ApiResponse::sendresponse(200,"no ads found", []);
//        }
//        return ApiResponse::sendresponse(200,"ads retrieved successfully", $ads);
//    }
//    public function top()
//    {
//        $ads = ad::where('status', 'top')->paginate(10)->sortByDesc('created_at');
//        $ads = $ads->values();
//
//        if($ads->isEmpty()){
//            return ApiResponse::sendresponse(200,"no ads found", []);
//        }
//        return ApiResponse::sendresponse(200,"ads retrieved successfully", $ads);
//    }

}
