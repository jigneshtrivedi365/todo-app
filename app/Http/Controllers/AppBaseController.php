<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class AppBaseController extends Controller
{
    protected $searchable = [];

    public static function success($message, $data = null)
    {
        $response['success'] = true;
        $response['message'] = $message;
        if ($data != null) {
            $response['data'] = $data;
        }

        return response()->json($response);
    }

    public static function error($message = null)
    {

        $response['status'] = false;
        if ($message != null) {
            $response['message'] = $message;
        }

        return response()->json($response);
    }
}
