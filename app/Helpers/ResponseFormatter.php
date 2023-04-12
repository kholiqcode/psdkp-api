<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class ResponseFormatter
{
    /**
     * API Response
     *
     * @var array
     */
    protected static $response = [
        'meta' => [
            'code' => Response::HTTP_OK,
            'status' => 'success',
            'message' => null,
        ],
        'data' => null,
    ];

    /**
     * Give success response.
     */
    public static function success($data = null, $message = 'Successfully', $code = Response::HTTP_OK)
    {
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    /**
     * Give error response.
     */
    public static function error($message = 'Failed', $code = Response::HTTP_BAD_REQUEST)
    {
        self::$response['meta']['code'] = $code;
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['message'] = $message;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
