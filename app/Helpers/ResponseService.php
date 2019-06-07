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
        };
        $headers = ['Content-type'=> 'application/json; charset=utf-8'];
        return response()->json($response, $statusCode, $headers, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        //JSON_UNESCAPED_UNICODE // tieng Viet co dau
        //JSON_PRETTY_PRINT   // format json de nhin
    }
}
