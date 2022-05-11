<?php

use App\Http\Controllers\Rightsmanagement\PermissionController;
use App\Http\Controllers\Rightsmanagement\RoleController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Users\UserController;
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

Route::post('users/confirm-password', [UserController::class, "confirmPassword"]);
Route::middleware('auth:api')->get('users/check-login', [UserController::class, "checkLogin"]);
Route::post('users/{user}/invite', [UserController::class, "inviteUser"]);
Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::get('roles/forUser/{user}', [RoleController::class, "getRolesForRequestingUser"]);
Route::apiResource('permissions', PermissionController::class);
Route::post('users/checkIfAdmin', [UserController::class, "checkIfUserHasFittingRole"]);
Route::delete('users/{user}/delete/{userToDelete}', [UserController::class, "delete"]);

Route::get('app', [AppController::class, "getApp"]);
