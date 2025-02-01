<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SectionsController extends Controller
{
    public function index()
    {
        $sections = section::all();
        return view('admin.sections.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $imageName = null;

        // Handle uploaded image
        if ($request->hasFile('image_upload')) {
            $image = $request->file('image_upload');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
        }

        $name = $request->input('title');
        Section::create([
            'name' => $name,
            'icon' => 'assets/images/' . $imageName,
        ]);

        return redirect()->route('admin.sections');
    }

    public function edit(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        $imageName = $section->icon;

        if ($request->hasFile('icon_upload')) {
            // Delete the old image if it exists
            if (File::exists(public_path($section->icon))) {
                File::delete(public_path($section->icon));
            }

            // Upload the new image
            $image = $request->file('icon_upload');
            $imageName = 'assets/images/' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
        }

        $section->name = $request->input('name');
        $section->icon = $imageName;
        $section->save();

        return redirect()->route('admin.sections');
    }

    public function show($id)
    {
        $section = Section::findOrFail($id);
        $categories = Category::where('section_id', $id)->paginate(10);
        return view('admin.sections.show', compact('section', 'categories'));
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);

        // Delete the image file if it exists
        if (File::exists(public_path($section->icon))) {
            File::delete(public_path($section->icon));
        }

        $section->delete();

        return redirect()->route('admin.sections')->with('success', __('keywords.section_deleted'));
    }
}
