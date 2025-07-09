<?php

use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Frontend\LayoutController;
use App\Http\Controllers\Frontend\PostDetailController;
use App\Http\Controllers\Frontend\PostListController;
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

Route::get('/layout', [LayoutController::class, 'index']);

Route::group(['prefix' => '/posts'], function () {
    Route::get('/', [PostListController::class, 'index']);
    Route::get('/{hash}', [PostDetailController::class, 'show']);
    Route::get('preview/{post}', [PostDetailController::class, 'preview'])
        ->middleware(['signed'])
        ->name('api.posts.preview');
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

