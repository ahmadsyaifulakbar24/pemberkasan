<?php
namespace App\Helpers;

class ResponseFormatter {

    public static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => NULL,
        ], 
        'data' => NULL,
    ];

    public static function success($data = NULL, $message = NULL)
    {
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function error($data = NULL, $message = NULL, $code = 400)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}