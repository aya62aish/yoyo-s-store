<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.create');
    }
    public function store(Request $request){
        $ele = setting::find(1);
        $ele->update([
           'phone' => $request->input('phone'),
           'email' => $request->input('email'),
        ]);
        return redirect()->back();
    }
}
