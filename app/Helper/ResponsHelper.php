<?php


namespace App\Helper;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponsHelper
{
    public static function successGetData($data, $message = "Successfully get data"): JsonResponse
    {
        return response()->json(
            [
                'status' => 200,
                'message' => $message,
                'data' => $data
            ]
        );
    }
    public static function successChangeData($data, $message = "Successfully change data"): JsonResponse
    {
        return response()->json(
            [
                'status' => 201,
                'message' => $message,
                'data' => $data
            ]
        );
    }
    public static function validatorError($error, $message = "Validator Error"): JsonResponse
    {
        return response()->json(
            [
                'status' => 442,
                'message' => $message,
                'data' => $error
            ]
        );
    }
    public static function conflictError($error, $message = "Conflict Error"): JsonResponse
    {
        return response()->json(
            [
                'status' => 409,
                'message' => $message,
                'data' => $error
            ]
        );
    }
    public static function authError($message = "Auth Error"): JsonResponse
    {
        return response()->json(
            [
                'status' => 401,
                'message' => $message
            ]
        );
    }
    public static function notFoundData($message = "Data Not Found"): JsonResponse
    {
        return response()->json(
            [
                'status' => 404,
                'message' => $message
            ]
        );
    }
}
