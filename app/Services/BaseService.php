<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BaseService
{

    public function __construct()
    {
        //
    }

    public function sendResponse($data, $success = true, $errors = null)
    {
        $response = [
            'success' => $success,
            'data'    => $data,
            'errors' => $errors
        ];

        return response()->json($response, 200);
    }


    public function sendErrorResponse($type, $message)
    {
        $response = [
            'success' => false,
            'data'    => null,
            'errors' => [
                [
                    "type" => $type,
                    "message" => $message
                ]
            ]
        ];

        return response()->json($response, 200);
    }

    public function handleException(\Throwable $th, $method)
    {
        $error = [
            'Exception' => get_class($th),
            'Message' => $th->getMessage(),
            'File' => $th->getFile(),
            'Line' => $th->getLine(),
        ];

        $this->generateLogs(
            $error,
            $method . ' - Catch Exception',
            'error'
        );

        return [
            'success' => false,
            'message' => "{$th->getMessage()}  File: {$th->getFile()}  Line  {$th->getLine()}",
        ];
    }


    public function generateLogs($data, $apiName, $type = "info")
    {
        Log::$type($apiName, $data);
    }
}
