<?php

namespace App\Http\Controllers;

use App\Models\ad;
use App\Models\category;
use App\Models\member;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MembersController extends Controller
{
    public function index(){
        $sections = section::all();
        $members = member::latest()->take(10)->get();
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
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'facebook' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
        ]);
        $logoPath = null;
        $coverPath = null;
        // Handle the logo upload
        if ($request->hasFile('logo')) {

            $logo = $request->file('logo');
            $logoPath = Str::random(10) . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('assets/images'), $logoPath);
        }

        // Handle the cover upload
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverPath = Str::random(10) . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('assets/images'), $coverPath);

        }

        member::create(
            [
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'phone' => $request->input('phone'),
                'whatsapp' => $request->input('whatsapp'),
                'location' => $request->input('location'),
                'facebook' => $request->input('facebook'),
                'icon' => 'assets/images/' . $logoPath,
                'cover' => 'assets/images/' . $coverPath,
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

        return view('admin.members.show', compact('category','section','member','ads'));
    }
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $validatedData = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'facebook' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($member->icon && file_exists(public_path($member->icon))) {
                unlink(public_path($member->icon));
            }

            $logo = $request->file('logo');
            $logoPath = Str::random(10) . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('assets/images'), $logoPath);
            $member->icon = 'assets/images/' . $logoPath;
        }

        // Handle cover upload
        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($member->cover && file_exists(public_path($member->cover))) {
                unlink(public_path($member->cover));
            }

            $cover = $request->file('cover');
            $coverPath = Str::random(10) . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('assets/images'), $coverPath);
            $member->cover = 'assets/images/' . $coverPath;
        }

        // Update other member details
        $member->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'section_id' => $request->input('section_id'),
            'phone' => $request->input('phone'),
            'whatsapp' => $request->input('whatsapp'),
            'location' => $request->input('location'),
            'facebook' => $request->input('facebook'),
        ]);

        return redirect()->route('admin.members');
    }
    public function destroy($id)
    {
        $member = member::find($id);
        // Delete old logo if exists
        if ($member->icon && file_exists(public_path($member->icon))) {
            unlink(public_path($member->icon));
        }
        if ($member->cover && file_exists(public_path($member->cover))) {
            unlink(public_path($member->cover));
        }
        $member = member::where('id', $id)->delete();
        return redirect()->route('admin.members')->with('success', __('keywords.section_deleted'));
    }
}
