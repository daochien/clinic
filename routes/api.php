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

    Route::get('group/members/{id}', 'API\V1\GroupController@members');
    Route::get('group/members/filter/{value}', 'API\V1\GroupController@filter');
    Route::post('group/members/add', 'API\V1\GroupController@addUsers');
    Route::get('group/members/group-users/{id}', 'API\V1\GroupController@getGroupUsersByGroup');
    Route::post('group/members/remove', 'API\V1\GroupController@removeUsers');

    Route::apiResources([
        'user' => 'API\V1\UserController',
        'product' => 'API\V1\ProductController',
        'category' => 'API\V1\CategoryController',
        'tag' => 'API\V1\TagController',
        'group' => 'API\V1\GroupController',
    ]);
});


Route::post('/login', 'API\V1\LoginController@login')->name('login_api');
