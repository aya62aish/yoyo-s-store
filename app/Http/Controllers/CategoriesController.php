<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\member;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(){
        $sections = section::all();
        $categories = category::latest()->take(10)->get();
        return view('admin.categories.create',compact('sections','categories'));
    }
    public function filter(Request $request){
        $categories = category::where('section_id',$request->section_id)->get();
        $sections = section::all();
//        dd($categories);
        return view('admin.categories.create',compact('sections','categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imageName = null;

        // Handle uploaded image
        if ($request->hasFile('icon')) {
            //dd('xx');
            $image = $request->file('icon');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
        }
//        dd( $request->file('image_upload'));
        category::create(
            [
                'name' => $request->input('name'),
                'section_id' => $request->input('section_id'),
                'icon' => 'assets/images/' . $imageName,
            ],
        );
        return redirect()->route('admin.categories');
    }
    public function show($id)
    {
        $category = category::findOrFail($id);
        $members = member::where('category_id',$id)->get();
        return view('admin.categories.show', compact('category','members'));
    }
    public function update(Request $request, $id)
    {
        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'section_id' => 'required|exists:sections,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the category to update
        $category = Category::findOrFail($id);

        // Update category name and section ID
        $category->name = $request->input('name');
        $category->section_id = $request->input('section_id');

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete the old icon if it exists
            $image = $request->file('icon');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);

            $category->icon =  'assets/images/' . $imageName;
        }

        // Save updated category information
        $category->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = category::where('id', $id)->delete();
        return redirect()->route('admin.categories')->with('suc cess', __('keywords.section_deleted'));
    }
}
