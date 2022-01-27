<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

// Route::get('posts', [PostController::class,'index']);
Route::apiResource('posts', PostController::class);
// Route::apiResource('categories', CategoryController::class);
// Route::get('category/{slug}/posts', [PostController::class,'categoryPosts']);
// Route::get('searchposts/{query}', [PostController::class,'searchposts']);
Route::post('register', [UserController::class,'register']);
Route::post('login', [UserController::class,'login']);
// Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class,'details']);

// });
// ,'middleware'=>'auth:api'],
Route::group(['prefix'=>'/admin'],function(){
    // Route::middleware('auth:api')->group(function () {
    Route::get('posts',[AdminController::class,'getPosts']);
    Route::post('addPost',[AdminController::class,'addPost']);
    Route::post('updatePost',[AdminController::class,'updatePost']);
    Route::post('deletePost/{id}',[AdminController::class,'deletePost']);
});
// Route::post('admin/addPost',[AdminController::class,'addPost']);
// Route::get('searchposts/{query}','PostController@searchposts');
