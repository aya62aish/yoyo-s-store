<?php

namespace App\Http\Controllers;
use App\Models\rating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{

    public function index(){
        $ratings = rating::paginate(10)->sortByDesc('created_at');
        return view('admin.rating.index', compact('ratings'));
    }
}
