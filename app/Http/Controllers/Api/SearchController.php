<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ad;
use App\Models\category;
use App\Models\member;
use App\Models\section;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->input('query');
        $page = $request->input('page', 1);
        $perPage = 10;
        $sectionQuery = Section::query();
        $categoryQuery = Category::query();
        $memberQuery = member::query();
        $adQuery = Ad::query();
        if ($query) {
            $sectionQuery->where('name', 'LIKE', "%$query%");
            $categoryQuery->where('name', 'LIKE', "%$query%");
            $adQuery->where('title', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%");
            $memberQuery->where('name', 'LIKE', "%$query%");
        }

        $sections = $sectionQuery->paginate($perPage, ['*'], 'page', $page);
        $categories = $categoryQuery->paginate($perPage, ['*'], 'page', $page);
        $ads = $adQuery->paginate($perPage, ['*'], 'page', $page);
        $members = $memberQuery->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'sections' => $sections->items(),
            'categories' => $categories->items(),
            'members' => $members->items(),
            'ads' => $ads->items(),
            'total_results' => $sections->total() + $categories->total() + $ads->total(),
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }
}
