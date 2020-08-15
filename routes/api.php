<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('profile', 'API\V1\ProfileController@profile')->name('profile.index');
    Route::put('profile', 'API\V1\ProfileController@updateProfile')->name('profile.update');
    Route::post('change-password', 'API\V1\ProfileController@changePassword')->name('profile.change.password');
    Route::get('tag/list', 'API\V1\TagController@list');
    Route::get('category/list', 'API\V1\CategoryController@list');
    Route::post('product/upload', 'API\V1\ProductController@upload');

    Route::get('clinic/{id}/user', 'API\V1\ClinicController@getUsers')->name('clinic.get.users');
    Route::post('clinic/{id}/user', 'API\V1\ClinicController@addUsers')->name('clinic.add.users');
    Route::get('clinic/all', 'API\V1\ClinicController@getAll')->name('api.clinic.all');

    Route::get('setting/type', 'API\V1\SettingController@getType')->name('api.setting.type');
    Route::get('setting/level', 'API\V1\SettingController@getLevel')->name('api.setting.level');

    Route::get('/logout', 'API\V1\Auth\LogoutController@logout')->name('api.logout');

    Route::get('/user/search', 'API\V1\UserController@search')->name('api.user.search');
    Route::get('/group/all', 'API\V1\UserController@getAllGroup')->name('api.group.all');

    Route::apiResources([
        'user' => 'API\V1\UserController',
        'clinic' => 'API\V1\ClinicController',
        'product' => 'API\V1\ProductController',
        'category' => 'API\V1\CategoryController',
        'tag' => 'API\V1\TagController',
    ]);
});


Route::post('/login', 'API\V1\Auth\LoginController@login')->name('api.login');
Route::post('/password/forgot', 'API\V1\Auth\ForgotPasswordController@sendResetLinkEmail')->name('api.password.forgot');
