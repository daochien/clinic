<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*')->middleware('auth');

Auth::routes();

//Route::get('/admin', 'Admin\HomeController@index')->name('admin_dashboard');
Route::get('/home', 'HomeController@index')->name('home');
