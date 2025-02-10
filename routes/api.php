<?php

use App\Http\Controllers\MMenuController;
use App\Http\Controllers\MRoleController;
use App\Http\Controllers\MRoleMenuController;
use App\Http\Controllers\MUserController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/register", [MUserController::class, "register"])->name("register");
Route::post("/login", [MUserController::class, "login"])->name("login");
Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post("/logout", [MUserController::class, "logout"])->name("logout");
    Route::apiResources([
        'user' => MUserController::class,
        'menu' => MMenuController::class,
        'role' => MRoleController::class,
        'rolemenu' => MRoleMenuController::class,
    ]);
});
