<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

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

Route::apiResource('posts', PostController::class);
Route::apiResource('categories', CategoryController::class);
Route::get('category/{slug}/posts', [PostController::class,'categoryPosts']);
Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);
// Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class,'details']);
    Route::post('comment/create', [CommentController::class,'store']);

// });
// ,'middleware'=>'auth:api'],
Route::group(['prefix'=>'/admin'],function(){
    // Route::middleware('auth:api')->group(function () {
    Route::get('posts',[AdminController::class,'getPosts']);
    Route::get('categories',[AdminController::class,'getCategories']);
    Route::post('addPost',[AdminController::class,'addPost']);
    Route::post('updatePost',[AdminController::class,'updatePost']);
    Route::post('deletePost/{id}',[AdminController::class,'deletePost']);
});

