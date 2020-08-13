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

    Route::post('clinic/{id}/user', 'API\V1\ClinicController@addUsers')->name('clinic.add.users');

    Route::apiResources([
        'user' => 'API\V1\UserController',
        'clinic' => 'API\V1\ClinicController',
        'product' => 'API\V1\ProductController',
        'category' => 'API\V1\CategoryController',
        'tag' => 'API\V1\TagController',
    ]);
});


Route::post('/login', 'API\V1\LoginController@login')->name('login_api');
Route::post('/password/forgot', 'API\V1\Auth\ForgotPasswordController@sendResetLinkEmail')->name('api.password.forgot');
