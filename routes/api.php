<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;

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

// List Articles
Route::get('articles', [ArticlesController::class, 'index']);

// List single Article
Route::get('article/{id}', [ArticlesController::class, 'show']);

// New Article
Route::post('article', [ArticlesController::class, 'store']);

// Update Article
Route::put('article', [ArticlesController::class, 'store']);

// delete Article
Route::delete('article/{id}', [ArticlesController::class, 'destroy']);