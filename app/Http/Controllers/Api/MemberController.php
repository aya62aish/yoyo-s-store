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
        return ApiResponse::sendresponse(200, 'No members found.',[]);
    }
    public function show($id) {
        $member = Member::find($id);

        if($member) {
            return ApiResponse::sendresponse(200, 'members retrieved successfully.',new MembersResource2($member));
        }
        return ApiResponse::sendresponse(200, 'No member found.',[]);
    }
    public function favourite (Request $request){
        $user = auth()->user();
        $favorites = $user->favoriteMembers()->get();
//        $members = member::where('status','favourite')->get();
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
        if(count($favorites) > 0) {
            return ApiResponse::sendresponse(200,'members retrieved successfully.', MembersResource2::collection($favorites));
        }
        return ApiResponse::sendresponse(200, 'No members found.', []);
    }
    public function favourites (Request $request, $id) {
        $members = member::find($id);
        if($members) {
            $user = auth()->user();

            if ($user->favoriteMembers()->where('member_id', $id)->exists()) {
                $user->favoriteMembers()->detach($id);
            } else {
                $user->favoriteMembers()->attach($id);
            }

            return ApiResponse::sendresponse(200, 'members updated successfully.', []);
        }
        return ApiResponse::sendresponse(200, 'No members found.', []);




//        $members = member::find($id);
//        if($members) {
//            if($members->status == 'favourite') {
//                member::where('id',$id)->update(['status' => 'normal']);
//            }
//            else {
//                member::where('id',$id)->update(['status' => 'favourite']);
//            }
//            return ApiResponse::sendresponse(200,'members updated successfully.', []);
//        }
//        return ApiResponse::sendresponse(200, 'No members found.', []);
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
