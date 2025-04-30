<?php

namespace  Modules\CommonService\Shared\Handler;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class Result
{
    public static function success($data, $message = 'Success', $status = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function success_with_token($data, $token, $message = 'Success', $status = 200)
    {

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'token' => $token
        ], $status);
    }

    public static function error($message, $status = 400)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $status);
    }
}
