<?php

namespace App\Http\Controllers;

use App\Models\ad;
use App\Models\banners;
use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannersController extends Controller
{
    public function index(){
        $banners = banners::latest()->take(10)->get();
        return view('admin.banners.create',compact('banners'));
    }
    public function store(Request $request){

      $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'link' => 'nullable|url|required_without:member_id',
        'member_id' => 'nullable|exists:members,id|required_without:link'
    ]);
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
        }

        banners::create([
            'image' =>  'assets/images/' . $imageName,
            'link' =>  $request->link,
            'member_id' => $request->member_id,
        ]);
        return redirect()->back();
    }
    public function destroy(Request $request,$id){
        $ad = banners::where('id', $id)->delete();
        return redirect()->back();
    }
  public function searchMembers(Request $request)
    {
        $query = $request->get('query');
        $members = member::where('name', 'LIKE', "%{$query}%")->get(['id', 'name']);
     return response()->json($members);
    }
}
