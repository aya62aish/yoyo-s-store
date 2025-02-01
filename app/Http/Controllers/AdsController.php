<?php

namespace App\Http\Controllers;

use App\Models\ad;
use App\Models\category;
use App\Models\member;
use App\Models\section;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class AdsController extends Controller
{
    public function index(){
        $sections = section::all();
        $ads = [];
        return view('admin.ads.create',compact('ads','sections'));
    }
    public function getCategoriesBySection($sectionId)
    {
        $categories = category::where('section_id', $sectionId)->get(['id', 'name']);
        return response()->json($categories);
    }
    public function getMemberByCategory($categoryId){
        $members = member::where('category_id', $categoryId)->get(['id', 'name']);
        return response()->json($members);
    }
    public function filter(Request $request){
        $ads = ad::where('member_id',$request->member_id)->get();
        $sections = section::all();

        return view('admin.ads.create',compact('ads','sections'));
    }


    public function store(Request $request){

        $imageName = null;

        // Handle uploaded image
        if ($request->hasFile('image_upload')) {
            //dd('xx');
            $image = $request->file('image_upload');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
        }
        ad::create(
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => 'assets/images/' . $imageName,
                'member_id' => $request->input('member_id'),
                'status' => $request->input('status'),
            ],
        );
        return redirect()->route('admin.ads');
    }

    public function show($id)
    {
        $ad = ad::find($id);
        $member = member::find($ad->member_id);
        $category = $member->category->name;
        $section = $member->category->section_id;
        $section = section::find($section)->name;
        $member= $member->name;
        return view('admin.ads.show', compact('category','section','member','ad'));
    }
    public function destroy($id)
    {
        $ad = ad::where('id', $id)->delete();
        return redirect()->route('admin.ads')->with('success', __('keywords.section_deleted'));
    }
}
