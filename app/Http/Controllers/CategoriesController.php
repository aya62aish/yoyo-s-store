<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\member;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index(){
        $sections = section::all();
        $categories = [];
        return view('admin.categories.create',compact('sections','categories'));
    }
    public function filter(Request $request){
        $categories = category::where('section_id',$request->section_id)->get();
        $sections = section::all();
//        dd($categories);
        return view('admin.categories.create',compact('sections','categories'));
    }

    public function store(Request $request){
        $name = $request->input('name');
        $section_id = $request->input('section_id');
        category::create(
            ['name' => $name
            ,'section_id' => $section_id],
        );
        return redirect()->route('admin.categories');
    }
    public function show($id)
    {
        $category = category::findOrFail($id);
        $members = member::where('category_id',$id)->get();
        return view('admin.categories.show', compact('category','members'));
    }
    public function destroy($id)
    {
        $category = category::where('id', $id)->delete();
        return redirect()->route('admin.categories')->with('suc cess', __('keywords.section_deleted'));
    }
}
