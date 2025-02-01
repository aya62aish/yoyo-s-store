<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationsResource;
use App\Models\location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $location = location::all();
        if(count($location)>0){
            return ApiResponse::sendresponse(200, "Location List", LocationsResource::collection($location));
        }
        return ApiResponse::sendresponse(200 , "no locations found",[]);
    }
}
