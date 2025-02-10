<?php

use App\Http\Controllers\MMenuController;
use App\Http\Controllers\MRoleController;
use App\Http\Controllers\MRoleMenuController;
use App\Http\Controllers\MUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResources([
    'user' => MUserController::class,
    'menu' => MMenuController::class,
    'role' => MRoleController::class,
    'rolemenu' => MRoleMenuController::class,
]);
