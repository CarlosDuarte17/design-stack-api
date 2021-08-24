<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//
Route::apiResource('users', UserController::class)
    ->only(['index', 'show'])
    ->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class)
    ->only(['index', 'store'])
    ->middleware('auth:sanctum');

Route::apiResource('tags', TagController::class)
    ->only(['show'])
    ->middleware('auth:sanctum');


Route::post('/login', [LoginController::class, 'login']);
