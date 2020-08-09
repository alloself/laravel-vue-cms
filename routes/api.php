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

Route::namespace('Api')->group(function () {
    Route::post('/login', 'AuthController@login')->name('login');
    Route::post('/reset', 'AuthController@reset')->name('reset');
    Route::prefix('auth')->middleware('auth:api')->group(function () {
        Route::get('image/download/{id}', 'ImageController@download');
        Route::get('/user', 'AuthController@user')->name('user');
        Route::post('/logout', 'AuthController@logout')->name('logout');
        Route::prefix('all')->group(function () {
            Route::get('page', 'PageController@all');
            Route::get('menu', 'MenuController@all');
            Route::get('card_block', 'CardBlockController@all');
        });
        Route::apiResource('page', 'PageController');
        Route::apiResource('image', 'ImageController');
        Route::apiResource('menu', 'MenuController');
        Route::apiResource('carousel_block', 'CarouselBlockController');
        Route::apiResource('card_block', 'CardBlockController');
        Route::apiResource('text_block', 'TextBlockController');
        Route::apiResource('wysiwyg_block', 'WysiwygBlockController');
    });
});
