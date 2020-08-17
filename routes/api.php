<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['name' => 'api.', 'middleware' => 'check.permission'], function () {

        Route::get('profile', 'API\V1\ProfileController@profile');
        Route::put('profile', 'API\V1\ProfileController@updateProfile');
        Route::post('change-password', 'API\V1\ProfileController@changePassword');
        Route::get('tag/list', 'API\V1\TagController@list');
        Route::get('category/list', 'API\V1\CategoryController@list');
        Route::post('product/upload', 'API\V1\ProductController@upload')->name('product.upload');

        Route::get('clinic/{id}/user', 'API\V1\ClinicController@getUsers')->name('clinic.get.users');
        Route::post('clinic/{id}/user', 'API\V1\ClinicController@addUsers')->name('clinic.add.users');
        Route::get('clinic/all', 'API\V1\ClinicController@getAll')->name('api.clinic.all');

        Route::get('setting/type', 'API\V1\SettingController@getType')->name('api.setting.type');
        Route::get('setting/level', 'API\V1\SettingController@getLevel')->name('api.setting.level');

        Route::get('/logout', 'API\V1\Auth\LogoutController@logout')->name('api.logout');

        Route::get('/user/search', 'API\V1\UserController@search')->name('api.user.search');
        Route::get('/group/all', 'API\V1\UserController@getAllGroup')->name('api.group.all');

        Route::get('role/list', 'API\V1\RoleController@list')->name('role.list');
        Route::get('permission/list', 'API\V1\PermissionController@list')->name('permission.list');
        Route::get('permission/routes', 'API\V1\PermissionController@listRoutes')->name('permission.routes');

        Route::apiResources([
            'user' => 'API\V1\UserController',
            'product' => 'API\V1\ProductController',
            'category' => 'API\V1\CategoryController',
            'tag' => 'API\V1\TagController',
            'blog' => 'API\V1\BlogController',
            'manager' => 'API\V1\AdminController',
            'role' => 'API\V1\RoleController',
            'permission' => 'API\V1\PermissionController'
        ]);


    });

});


Route::post('/login', 'API\V1\Auth\LoginController@login')->name('api.login');
Route::post('/password/forgot', 'API\V1\Auth\ForgotPasswordController@sendResetLinkEmail')->name('api.password.forgot');
