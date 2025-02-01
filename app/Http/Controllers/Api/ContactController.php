<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Mail\ContactMessage;
use App\Models\contact;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreMessageRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $email = setting::find(1)->email;

        contact::create(
            [
                'name' => $data['name'],
                'message' => $data['message'],
            ]);
        $data['name'] = $user['name'];
        $data['email'] = $user['email'];
        $data['phone'] = $user['phone'];
//        dd($data);
        Mail::to($email)->send(new ContactMessage($data));
        return ApiResponse::sendresponse(201,"Message has been sent",[]);

    }
}
