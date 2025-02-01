<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index() {
        $contacts = Setting::find(1);
        return ApiResponse::sendresponse(200,'settings retrieved successfully',$contacts);
    }

}
