<?php

use Illuminate\Http\Request;
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

Route::middleware(['auth:api'])->prefix('article')->group(function () {
    Route::get('/', [\Modules\Article\App\Http\Controllers\Article\ArticleController::class,"getArticlePaginate"])->name('article');
    Route::get('/{id}', [\Modules\Article\App\Http\Controllers\Article\ArticleController::class,"findById"])->name('article.id');
    Route::post('/', [\Modules\Article\App\Http\Controllers\Article\ArticleController::class,"store"])->name('article.create');
    Route::patch('/{id}', [\Modules\Article\App\Http\Controllers\Article\ArticleController::class,"update"])->name('article.update.id');

});