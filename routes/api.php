<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('users/confirm-password', [UsersController::class, "confirmPassword"]);
Route::get('users/check-login', [UsersController::class, "checkLogin"]);
Route::post('users/{user}/invite', [UsersController::class, "inviteUser"]);
Route::apiResource('users', UsersController::class);

Route::get('app', [AppController::class, "getApp"]);
