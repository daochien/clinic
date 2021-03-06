<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['verify' => true]);
Route::get('/password/reset/app/{token}', 'Auth\ResetPasswordController@resetPasswordByApp')->name('password.mobile.reset');
Route::prefix('/notification/')
    ->middleware('auth')
    ->namespace('Client')
    ->name('notification.')
    ->group(function () {
        Route::get('/', 'NotificationController@index')->name('index');
    });

Route::prefix('/blogs/')
    ->middleware('auth')
    ->namespace('Client')
    ->name('blog.')
    ->group(function () {
        Route::get('/', 'PageController@index')->name('index');
        Route::get('/{id}', 'PageController@index')->name('detail')->middleware('check.page.active');
    });

Route::prefix('/manual/')
    ->middleware('auth')
    ->namespace('Client')
    ->name('qa.')
    ->group(function () {
        Route::get('/', 'PageController@index')->name('index');
        Route::get('/downloadUrl', 'PageController@downloadUrl')->name('downloadUrl');
    });



//Route::get('/admin', 'Admin\HomeController@index')->name('admin_dashboard');
//Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/admin/template', 'Admin\Template\FormController')->except('index');
Route::get('request/download/attachment/{filename}', 'API\V1\RequestController@downloadAttachment')->name('request.attachment.download');

Route::prefix('/admin/template')
    ->namespace('Admin\Template')
    ->name('template.')
    ->group(function () {
        Route::get('/render/{identifier}', 'RenderFormController@render')->name('render');
        Route::post('/render/{identifier}', 'RenderFormController@submit')->name('submit');
        Route::get('/render/{identifier}/feedback', 'RenderFormController@feedback')->name('feedback');

        Route::resource('/my-request', 'MySubmissionController');

        Route::prefix('/{fid}')
            ->group(function () {
                Route::resource('/request', 'SubmissionController');
            });

    });

Route::get('/my-account', 'Admin\UserController@myAccount')->name('my-account');
Route::prefix('admin')->group(function() {
    Route::get('/{vue_capture?}', 'HomeController@index')->where('vue_capture', '[\/\w\.-]*')->middleware(['auth', 'check.notAdministrator']);
});



