<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::group(['name' => 'permission'], function () {

    });
    Route::group(['name' => 'api.', 'middleware' => 'check.permission'], function () {
        Route::get('profile', 'API\V1\ProfileController@profile')->name('profile.index');
        Route::put('profile', 'API\V1\ProfileController@updateProfile')->name('profile.update');
        Route::post('change-password', 'API\V1\ProfileController@changePassword')->name('profile.change.password');
        Route::get('tag/list', 'API\V1\TagController@list');
        Route::get('category/list', 'API\V1\CategoryController@list');
        Route::post('product/upload', 'API\V1\ProductController@upload');
        Route::get('group/{id}/members', 'API\V1\GroupController@members');
        Route::get('notification/{id}/members', 'API\V1\NotificationController@members');

        Route::post('clinic/{id}/user', 'API\V1\ClinicController@addUsers')->name('clinic.add.users');

        Route::apiResources([
            'user' => 'API\V1\UserController',
            'clinic' => 'API\V1\ClinicController',
            'product' => 'API\V1\ProductController',
            'template' => 'API\V1\TemplateController',
            'category' => 'API\V1\CategoryController',
            'tag' => 'API\V1\TagController',
            'notification' => 'API\V1\NotificationController',
            'group' => 'API\V1\GroupController',
            'blog' => 'API\V1\BlogController',
            'role' => 'API\V1\RoleController',
            'permission' => 'API\V1\PermissionController',
            'manager' => 'API\V1\AdminController',
        ]);
    });
});


Route::post('/login', 'API\V1\LoginController@login')->name('login_api');
