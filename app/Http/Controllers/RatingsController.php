<?php

namespace App\Http\Controllers;
use App\Models\rating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{

    public function index(){
        $ratings = rating::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.rating.index', compact('ratings'));
    }
}
