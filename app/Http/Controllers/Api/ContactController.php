<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\contact;

class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreMessageRequest $request)
    {
        $data = $request->validated();
        contact::create(
            [
                'name' => $data['name'],
                'message' => $data['message'],
            ]);
        return ApiResponse::sendresponse(201,"Message has been sent",[]);

    }
}
