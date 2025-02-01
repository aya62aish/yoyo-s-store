<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Models\rating;

class RatingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RatingRequest $request)
    {
        $data = $request->validated();
        rating::create(
            [
                'review' => $data['review'],
                'rating' => $data['rating'],
            ]);
        return ApiResponse::sendresponse(201,"rate has been sent",[]);
    }
}
