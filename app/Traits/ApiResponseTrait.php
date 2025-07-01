<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function success($message = '', $data = [], $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function error($message = '', $code = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }
}
