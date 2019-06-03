<?php

namespace App\Helpers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;

class ResponseService extends ServiceProvider
{

    public static function response($success, $message, $statusCode, $data = 'none', $info = 'none', $moreInfo = 'moreInfo')
    {
        if ($moreInfo == 'moreInfo' || $info == 'none') {
            $response = [
                'success' => $success,
                'message' => $message,
                'statusCode' => $statusCode,
                'data' => $data
            ];
        } else {
            $response = [
                'success' => $success,
                'message' => $message,
                'statusCode' => $statusCode,
                'data' => $data,
                $moreInfo => $info
            ];
        }
        return response()->json($response);
    }
}
