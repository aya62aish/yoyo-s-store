<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResourse;
use App\Http\Resources\SectionsResourse;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $categ = category::where('section_id', $request->input('id'))->get();
        if($categ){
            return ApiResponse::sendresponse(200,'categories retrieved successfully',  CategoryResourse::collection($categ));
        }
        return ApiResponse::sendresponse(200,'category is empty');
    }
}
