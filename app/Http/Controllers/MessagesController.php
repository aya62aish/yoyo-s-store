<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(){
     $messages = message::paginate(10)->sortByDesc('created_at');
     return view('admin.messages.index', compact('messages'));
    }
}
