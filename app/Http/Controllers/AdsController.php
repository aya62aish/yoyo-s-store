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
        $ads = ad::latest()->take(10)->get();
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
                'discount' => $request->input('discount'),
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
        $ad = ad::find($id);
        // Delete old image if exists
        if ($ad->image && file_exists(public_path($ad->image))) {
            unlink(public_path($ad->image));
        }
        $ad = ad::where('id', $id)->delete();
        return redirect()->route('admin.ads')->with('success', __('keywords.section_deleted'));
    }
    public function edit(Request $request, $id)
    {
        $ad = ad::findOrFail($id);

        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'member_id' => 'nullable|exists:members,id',
            'title' => 'required|string|max:255',
            'discount' => 'nullable|numeric|min:0|max:100',
            'description' => 'required|string',
            'image_upload' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'status' => 'required|in:normal,top',
        ]);

        // Handle logo upload
        if ($request->hasFile('image_upload')) {
            // Delete old logo if exists
            if ($ad->image && file_exists(public_path($ad->image))) {
                unlink(public_path($ad->image));
            }

            $logo = $request->file('image_upload');
            $logoPath = Str::random(10) . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('assets/images'), $logoPath);
            $ad->image = 'assets/images/' . $logoPath;
        }

        $ad->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'member_id' => $request->input('member_id'),
            'status' => $request->input('status'),
            'discount' => $request->input('discount'),
            'section_id' => $request->input('section_id'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('admin.ads');
    }
    public function search(Request $request)
    {
        $query = $request->query('query');

        // Perform search in the ads table (adjust this query as needed)
        $ads = member::where('name', 'LIKE', "%{$query}%")
            ->take(10) // Limit results to improve performance
            ->get(['id', 'title']); // Only retrieve the id and title

        // Return results as JSON
        return response()->json($ads);
    }
}
