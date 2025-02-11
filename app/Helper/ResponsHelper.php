<?php


namespace App\Helper;

use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class ResponsHelper
{
    public static function successGetData($data, $message = "Successfully get data"): JsonResponse
    {
        $token = JWTAuth::getToken();
        $token = JWTAuth::refresh($token);
        return response()->json(
            [
                'status' => 200,
                'message' => $message,
                'data' => $data,
                'access_token' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
                ]
            ]
        );
    }
    public static function successChangeData($data, $message = "Successfully change data"): JsonResponse
    {
        $token = JWTAuth::getToken();
        $token = JWTAuth::refresh($token);
        return response()->json(
            [
                'status' => 201,
                'message' => $message,
                'data' => $data,
                'access_token' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
                ]
            ]
        );
    }
    public static function validatorError($error, $message = "Validator Error"): JsonResponse
    {
        $token = JWTAuth::getToken();
        $token = JWTAuth::refresh($token);
        return response()->json(
            [
                'status' => 442,
                'message' => $message,
                'data' => $error,
                'access_token' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
                ]
            ]
        );
    }
    public static function conflictError($error, $message = "Conflict Error"): JsonResponse
    {
        $token = JWTAuth::getToken();
        $token = JWTAuth::refresh($token);
        return response()->json(
            [
                'status' => 409,
                'message' => $message,
                'data' => $error,
                'access_token' => [
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
                ]
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
    public static function customResponse($status, $message, $optional = []): JsonResponse
    {
        $responseData = [
            'status' => $status,
            'message' => $message,
        ];
        if (isset($optional['data'])) {
            $responseData["data"] = $optional['data'];
        }
        if (isset($optional['error'])) {
            $responseData["error"] = $optional['error'];
        }
        if (isset($optional['token'])) {
            $responseData["access_token"] = [
                'token' => $optional['token'],
                'token_type' => 'bearer',
                'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
            ];
        }
        return response()->json(
            $responseData
        );
    }
}
