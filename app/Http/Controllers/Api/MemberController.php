<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\MembersResourse;
use App\Http\Resources\MembersResource2;
use App\Models\ad;
use App\Models\member;
use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(Request $request) {
        $members = Member::where('category_id',$request->input('id'))->get();
        if(count($members) > 0) {
            return ApiResponse::sendresponse(200, 'members retrieved successfully.', MembersResourse::collection($members));
        }
        return ApiResponse::sendresponse(200, 'No members found.');
    }
    public function show($id) {
        $member = Member::find($id);

        if($member) {
            return ApiResponse::sendresponse(200, 'members retrieved successfully.',new MembersResource2($member));
        }
        return ApiResponse::sendresponse(200, 'No member found.');
    }
    public function favourite (){
        $members = member::where('status','favourite')->get();
//        member::create(
//            [
//                'name' => 'kael',
//                'location' => 'menofia',
//                'status' => 'normal',
//                'whatsapp' => '01001456168',
//                'phone'=> '01001456168',
//                'category_id' =>'1',
//                'facebook' =>'thi facebook'
//            ]
//        );
        if(count($members) > 0) {
            return ApiResponse::sendresponse(200,'members retrieved successfully.', MembersResourse::collection($members));
        }
        return ApiResponse::sendresponse(200, 'No members found.', []);
    }
    public function favourites (Request $request, $id) {
        $members = member::find($id);
        if($members) {
            member::where('id',$id)->update(['status' => 'favourite']);
            return ApiResponse::sendresponse(200,'members updated successfully.', []);
        }
        return ApiResponse::sendresponse(200, 'No members found.', []);
    }
    public function rate(Request $request, $id)
    {
      $review = review::create([
          'member_id' => $id,
          'rating' => $request->input('rating'),
          'comment' => $request->input('comment'),
          'user_id' => auth()->id(),
      ]);
        if($review) {
            return ApiResponse::sendresponse(200,'members rated successfully.', []);
        }
        return ApiResponse::sendresponse(200, 'No members found.', []);
    }
}
