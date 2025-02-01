<?php

namespace App\Http\Controllers;

use App\Models\ad;
use App\Models\category;
use App\Models\member;
use App\Models\section;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index(){
        $sections = section::all();
        $members = [];
        return view('admin.members.create',compact('members','sections'));
    }
    public function getCategoriesBySection($sectionId)
    {
        $categories = Category::where('section_id', $sectionId)->get(['id', 'name']);
        return response()->json($categories);
    }
    public function filter(Request $request){
        $members = member::where('category_id',$request->category_id)->get();
        $sections = section::all();
//        dd($members);
        return view('admin.members.create',compact('members','sections'));
    }

    public function store(Request $request){

        member::create(
            [
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'phone' => $request->input('phone'),
                'whatsapp' => $request->input('whatsapp'),
                'location' => $request->input('location'),
                'facebook' => $request->input('facebook'),
            ],
        );
        return redirect()->route('admin.members');
    }
    public function show($id)
    {
        $member = member::find($id);
        $category = $member->category->name;
        $section = $member->category->section_id;
        $section = section::find($section)->name;
        $ads = ad::where('member_id',$id)->get();
        $member= $member->name;
        return view('admin.members.show', compact('category','section','member','ads'));
    }
    public function destroy($id)
    {
        $member = member::where('id', $id)->delete();
        return redirect()->route('admin.members')->with('success', __('keywords.section_deleted'));
    }
}
