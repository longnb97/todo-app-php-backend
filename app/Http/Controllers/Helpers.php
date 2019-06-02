<?php

class Helper
{
    public static function message($success, $message, $statusCode)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'statusCode' => $statusCode
        ];
        
        return $response;
    }
}
