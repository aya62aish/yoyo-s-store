<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SectionsResourse;
use App\Models\section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sections = section::all();
        if (count($sections)) {
            return ApiResponse::sendresponse(200,"sections retrieved successfully", SectionsResourse::collection($sections));
        }
        return ApiResponse::sendresponse(200,"Sections are empty", []);
    }
}
