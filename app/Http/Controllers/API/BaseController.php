<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($data, $success = true, $errors = null)
    {
        $response = [
            'success' => $success,
            'data'    => $data,
            'errors' => $errors
        ];

        return response()->json($response, 200);
    }
}
