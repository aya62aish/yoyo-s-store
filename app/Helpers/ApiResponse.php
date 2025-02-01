<?php

namespace App\Helpers;

class ApiResponse {
    public static function sendresponse($code = 200, $msg = null, $data = null) {
        $response = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return response()->json($response, $code);
    }
}
