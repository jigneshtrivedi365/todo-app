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

    public static function error($data, $message = null)
    {

        $response['success'] = false;
        if ($message != null) {
            $response['message'] = $message;
        }
        $response['data'] = $data;

        return response()->json($response);
    }

    public function search($query)
    {
        $search = request()->get('search');

        if (!empty($search)) {
            $query = $query->where(function () use ($query, $search) {
                foreach ($this->searchable as $fieldName) {
                    if (Str::contains($fieldName, '.')) {
                        $relationShip = explode('.', $fieldName)[0];
                        $fieldName = explode('.', $fieldName)[1];

                        $query->orWhereHas($relationShip, function ($q) use ($fieldName, $search) {
                            $q->where($fieldName, 'LIKE', '%' . $search . '%');
                        });
                    } else {
                        $query->orWhere($fieldName, 'LIKE', '%' . $search . '%');
                    }
                }
            });
        }

        return $query;
    }
}
