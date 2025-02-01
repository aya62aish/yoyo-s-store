<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index($id)
    {
        $lang = User::find($id);
        if($lang){
            return ApiResponse::sendresponse(200,'language',$lang->lang);
        }
        return ApiResponse::sendresponse(422,'un founded user',[]);
    }
    public function store(Request $request,$id)
    {
        $lang = User::find($id);
        if($lang){
            User::where('id',$id)->update([
               'lang' => $request->input('lang')
            ]);
            return ApiResponse::sendresponse(200,'language updated',[]);
        }
        return ApiResponse::sendresponse(422,'un founded user',[]);
    }
}
