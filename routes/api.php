<?php

use App\Http\Api\Controllers\AuthController;
use App\Http\Api\Controllers\CommentController;
use App\Http\Api\Controllers\FilterController;
use App\Http\Api\Controllers\PostController;
use App\Http\Api\Controllers\PostImageController;
use App\Http\Api\Controllers\PostUserLikeController;
use App\Http\Api\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/auth/confirm', [AuthController::class, 'confirm']);
Route::post('/auth/register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/posts', PostController::class);

    Route::post('/posts/{post}/image', [PostImageController::class, 'store']);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);

    Route::post('/posts/{post}/like', PostUserLikeController::class);

    
    Route::get('/filter', [FilterController::class, 'index']);

    Route::post('/user/set_avatar', [UserController::class, 'set_avatar']);

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});