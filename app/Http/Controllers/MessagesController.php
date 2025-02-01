<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(){
     $messages = message::orderBy('created_at')->paginate(5);
     return view('admin.messages.index', compact('messages'));
    }
}
