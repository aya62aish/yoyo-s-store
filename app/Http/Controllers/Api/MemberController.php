<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\MembersResourse;
use App\Models\ad;
use App\Models\member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request) {
        $members = Member::where('id',$request->input('id'))->get();
        if(count($members) > 0) {
            return ApiResponse::sendresponse(200, 'members retrieved successfully.', MembersResourse::collection($members));
        }
        return ApiResponse::sendresponse(200, 'No members found.');
    }
    public function show($id) {
        $member = Member::find($id);
        if($member) {
//            ad::create(
//                [
//                    'member_id' => $member->id,
//                    'title' => "this is title",
//                    'description' => "this is description",
//                    'image' => "this is image",
//                ]
//            );
            return ApiResponse::sendresponse(200, 'members retrieved successfully.',new MembersResourse($member));
        }
        return ApiResponse::sendresponse(200, 'No member found.');
    }
}