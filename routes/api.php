<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;

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

Route::post('register', 'App\Http\Controllers\API\RegisterController@register');
Route::post('login', 'App\Http\Controllers\API\RegisterController@login');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group( function () {
    Route::get('posts/showbyuser', 'App\Http\Controllers\API\PostController@showbyuser');
    Route::get('posts/showbystatus/{status}', 'App\Http\Controllers\API\PostController@showbystatus');
    Route::post('posts/search', 'App\Http\Controllers\API\PostController@search');
    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('posts.comments', CommentController::class);
});


