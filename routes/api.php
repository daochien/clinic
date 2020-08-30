<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['name' => 'api.', 'middleware' => 'check.permission'], function () {
        Route::namespace('API\V1')
            ->prefix('/s3')
            ->group(function (): void {
                Route::post('/store', 'StorageController@store')->name('s3.store');
            });

        Route::get('profile', 'API\V1\ProfileController@profile')->name('profile.index');
        Route::put('profile', 'API\V1\ProfileController@updateProfile')->name('profile.update');
        Route::post('change-password', 'API\V1\ProfileController@changePassword')->name('profile.change.password');

        Route::namespace('API\V1')
            ->prefix('/notification')
            ->group(function (): void {
                Route::get('/{id}/members', 'NotificationController@members');
                Route::get('/{id}/show', 'NotificationController@show');
                Route::post('/store', 'NotificationController@store');
                Route::post('/search', 'NotificationController@search');
                Route::post('/detailSearch', 'NotificationController@detailSearch');
                Route::get('/fetch', 'NotificationController@fetch');
            });

        Route::get('setting/type', 'API\V1\SettingController@getType')->name('api.setting.type');
        Route::get('setting/level', 'API\V1\SettingController@getLevel')->name('api.setting.level');
        Route::get('setting/user-role', 'API\V1\SettingController@getUserRoles')->name('api.setting.user.role');

        Route::get('/logout', 'API\V1\Auth\LogoutController@logout')->name('api.logout');

        Route::get('/user/search', 'API\V1\UserController@search')->name('api.user.search');
        Route::get('/group/all', 'API\V1\UserController@getAllGroup')->name('api.group.all');

        Route::get('/group/list', 'API\V1\GroupController@all')->name('api.group.list');
        Route::get('group/members/{id}', 'API\V1\GroupController@users');
        Route::get('group/members/filter/{id}/{value}', 'API\V1\GroupController@filter');
        Route::post('group/members/add', 'API\V1\GroupController@addUsers');
        Route::get('group/members/group-users/{id}', 'API\V1\GroupController@getGroupUsersByGroup');
        Route::post('group/members/remove', 'API\V1\GroupController@removeUsers');

        Route::get('clinic/{id}/user', 'API\V1\ClinicController@getUsers')->name('clinic.get.users');
        Route::post('clinic/{id}/user', 'API\V1\ClinicController@addUsers')->name('clinic.add.users');
        Route::get('clinic/all', 'API\V1\ClinicController@getAll')->name('api.clinic.all');

        Route::get('setting/type', 'API\V1\SettingController@getType')->name('api.setting.type');
        Route::get('setting/level', 'API\V1\SettingController@getLevel')->name('api.setting.level');

        Route::get('/logout', 'API\V1\Auth\LogoutController@logout')->name('api.logout');

        Route::get('/user/search', 'API\V1\UserController@search')->name('api.user.search');
        Route::get('/group/default', 'API\V1\UserController@getAllGroupDefault')->name('api.group.default');

        Route::get('role/list', 'API\V1\RoleController@list')->name('role.list');
        Route::get('permission/list', 'API\V1\PermissionController@list')->name('permission.list');
        Route::get('permission/routes', 'API\V1\PermissionController@listRoutes')->name('permission.routes');

        Route::post('page/upload-image-content', 'API\V1\PageController@uploadImageContent')->name('page.uploadImageContent');

        Route::get('category/type/{type}', 'API\V1\CategoryController@getByType')->name('category.list.by.type');
        Route::get('template/{id}', 'API\V1\TemplateController@show')->name('api.template.show');
        Route::delete('template/{id}', 'API\V1\TemplateController@destroy')->name('api.template.destroy');
        Route::get('template/', 'API\V1\TemplateController@index')->name('template.index');
        Route::get('request/category/{id}', 'API\V1\RequestController@indexByCategory')->name('request.category.list');

        Route::apiResources([
            'user' => 'API\V1\UserController',
            'clinic' => 'API\V1\ClinicController',
            'category' => 'API\V1\CategoryController',
            'notification' => 'API\V1\NotificationController',
            'group' => 'API\V1\GroupController',
            'page' => 'API\V1\PageController',
            'manager' => 'API\V1\AdminController',
            'role' => 'API\V1\RoleController',
            'permission' => 'API\V1\PermissionController'
        ]);
    });
});

Route::post('/login', 'API\V1\Auth\LoginController@login')->name('api.login');
Route::post('/password/forgot', 'API\V1\Auth\ForgotPasswordController@sendResetLinkEmail')->name('api.password.forgot');
