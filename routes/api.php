<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', function (Request $request) {
        dd(123);
        return $request->user();
    });

    Route::get('profile', 'API\V1\ProfileController@profile');
    Route::put('profile', 'API\V1\ProfileController@updateProfile');
    Route::post('change-password', 'API\V1\ProfileController@changePassword');
    Route::get('tag/list', 'API\V1\TagController@list');
    Route::get('category/list', 'API\V1\CategoryController@list');
    Route::post('product/upload', 'API\V1\ProductController@upload');
    Route::get('group/list', 'API\V1\GroupController@list');
    Route::get('group/edit/{id}', 'API\V1\GroupController@find');

    Route::apiResources([
        'user' => 'API\V1\UserController',
        'product' => 'API\V1\ProductController',
        'category' => 'API\V1\CategoryController',
        'tag' => 'API\V1\TagController',
        'group' => 'API\V1\GroupController',
    ]);
});


Route::post('/login', 'API\V1\LoginController@login')->name('login_api');
