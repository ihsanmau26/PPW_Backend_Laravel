<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AuthenticationController;

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

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/forgot-password', [PasswordController::class, 'forgotPassword']);
Route::post('/reset-password', [PasswordController::class, 'resetPassword']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
    Route::post('/change-password', [PasswordController::class, 'changePassword'])->middleware('account-owner');

    Route::get('/users/admins', [UserController::class, 'indexAdmins'])->middleware('admin-only');
    Route::get('/users/admins/{id}', [UserController::class, 'showAdmin'])->middleware('admin-only');

    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{id}', [ArticleController::class, 'show']);
    Route::post('/articles', [ArticleController::class, 'store'])->middleware('admin-or-doctor');
    Route::patch('/articles/{id}', [ArticleController::class, 'update'])->middleware('article-owner');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->middleware('article-owner');
    
    Route::post('/comments', [CommentController::class, 'store']);
    Route::patch('/comments/{id}', [CommentController::class, 'update'])->middleware('comment-owner');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->middleware('comment-owner');
});
