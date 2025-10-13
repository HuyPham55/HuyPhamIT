<?php

use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\Comments\DestroyController;
use App\Http\Controllers\Frontend\Comments\ListController;
use App\Http\Controllers\Frontend\Comments\StoreReplyController;
use App\Http\Controllers\Frontend\Comments\StoreRootController;
use App\Http\Controllers\Frontend\Comments\UpdateController;
use App\Http\Controllers\Frontend\LayoutController;
use App\Http\Controllers\Frontend\PostDetailController;
use App\Http\Controllers\Frontend\PostListController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('layout', [LayoutController::class, 'index']);

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [PostListController::class, 'index']);
    Route::get('/{hash}', [PostDetailController::class, 'show']);
    Route::get('preview/{post}', [PostDetailController::class, 'preview'])
        ->middleware(['signed'])
        ->name('api.posts.preview');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/{post}/bookmark', [PostDetailController::class, 'bookmark']);
    });
});

// Authentication routes
Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => 'throttle:60:1'], function () {
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
        Route::post('register', [RegisteredUserController::class, 'store']);
    });
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
    });
});

// constrain the {type} segment and bind {owner} dynamically
Route::pattern('type', implode('|', [Post::BIND_TYPE]));;
Route::prefix('{type}/{id}')->group(callback: function () {
    Route::get('comments', [CommentController::class, 'getComments']); // GET /posts/{post}/comments
    Route::post('comments', [CommentController::class, 'postComment'])->middleware('auth:sanctum'); // POST /posts/{post}/comments
});
Route::prefix('comments/{comment}')->group(function () {
    Route::post('replies', [CommentController::class, 'replies']); // POST /comments/{comment}/replies
    Route::patch('', [CommentController::class, 'updateComment']); // PATCH /comments/{comment}
    Route::delete('', [CommentController::class, 'deleteComment']); // DELETE /comments/{comment}
})->middleware('auth:sanctum');
