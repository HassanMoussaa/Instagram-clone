<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group(function () {




    Route::controller(AuthController::class)->group(function () {
        // Route::post('login', 'login');
        // Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });



    Route::get('posts/following', [PostController::class, 'getFollowingPosts']);
    Route::post('user/follow/{userId}', [FollowController::class, 'followUser']);
    Route::post('user/unfollow/{userId}', [FollowController::class, 'unfollowUser']);


    Route::post('posts/add', [PostController::class, 'createPost']);
    Route::post('posts/like/{postId}', [LikeController::class, 'likePost']);
    Route::post('posts/unlike/{postId}', [LikeController::class, 'unlikePost']);
    Route::get('/posts/liked/{postId}', [LikeController::class, 'isPostLikedByUser']);

    Route::get('/search/users', [SearchController::class, 'searchUsers']);
    Route::get('/users', [SearchController::class, 'getAllUsers']);




});



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});