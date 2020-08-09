<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

//Route::get('/admin', 'Admin\HomeController@index')->name('admin_dashboard');
//Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/admin/template', 'Admin\Template\FormController');

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


Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*')->middleware('auth');
