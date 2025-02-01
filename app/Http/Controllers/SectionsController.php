<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionsController extends Controller
{
    public function index(){
        $sections = section::all();

        return view('admin.sections.create',compact('sections'));
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

        $name = $request->input('title');
        section::create(
            ['name' => $name,
                'icon' => 'assets/images/' . $imageName,
            ],
        );
        return redirect()->route('admin.sections');
    }
    public function edit(Request $request, $id){
        dd($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required',
        ]);
        $imageName = null;
        if ($request->hasFile('image_upload')) {
            //dd('xx');
            $image = $request->file('image_upload');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
        }

        $section = Section::findOrFail($id);
        $section->name = $request->input('name');
        $section->icon = $imageName;
        $section->save();
        return redirect()->route('admin.sections');
    }
    public function show($id)
    {
        $section = Section::findOrFail($id);
        $categories = Category::where('section_id',$id)->get();
        return view('admin.sections.show', compact('section','categories'));
    }
    public function destroy($id)
    {
        $section = section::where('id', $id)->delete();
        return redirect()->route('admin.sections')->with('suc cess', __('keywords.section_deleted'));
    }
}
