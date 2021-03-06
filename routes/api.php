<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('API\V1')
    ->prefix('/notification')
    ->group(function (): void {
        Route::get('/fetch', 'NotificationController@fetch');
        Route::put('/status', 'NotificationController@updateStatus');
    });

Route::middleware(['auth:sanctum', 'auth'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/logout', 'API\V1\Auth\LogoutController@logout')->name('api.logout');

    Route::group(['name' => 'api.', 'middleware' => 'check.permission'], function () {
        Route::namespace('API\V1')
            ->prefix('/s3')
            ->group(function (): void {
                Route::post('/store', 'StorageController@store')->name('s3.store');
            });

        Route::namespace('API\V1')
            ->prefix('/notification')
            ->as('notification.')
            ->group(function (): void {
                Route::get('/{id}/members', 'NotificationController@members')->name('members');
                Route::get('/{id}/show', 'NotificationController@show')->name('show');
                Route::post('/store', 'NotificationController@store')->name('store');
                Route::delete('/delete/{id}', 'NotificationController@remove')->name('remove');
                Route::post('/search', 'NotificationController@search')->name('search');
                Route::post('/detailSearch', 'NotificationController@detailSearch')->name('search.detail');
            });

        Route::get('profile', 'API\V1\AdminController@profile')->name('profile.index');
        Route::put('profile', 'API\V1\ProfileController@updateProfile')->name('profile.update');
        Route::post('change-password', 'API\V1\ProfileController@changePassword')->name('profile.change.password');
        Route::post('change-my-password', 'API\V1\ProfileController@changeMyPassword')->name('profile.change.my.password');
        Route::get('category/type/{type}', 'API\V1\CategoryController@getByType')->name('category.list.by.type');
        Route::get('category/{id}', 'API\V1\CategoryController@show')->name('category.show');
        Route::get('/user/search', 'API\V1\UserController@search')->name('api.user.search');
        Route::get('role/list', 'API\V1\RoleController@list')->name('role.list');

        Route::get('setting/type', 'API\V1\SettingController@getType')->name('api.setting.type');
        Route::get('setting/level', 'API\V1\SettingController@getLevel')->name('api.setting.level');
        Route::get('setting/user-role', 'API\V1\SettingController@getUserRoles')->name('api.setting.user.role');

        Route::get('/group/list', 'API\V1\GroupController@all')->name('api.group.list');
        Route::get('group/members/{id}', 'API\V1\GroupController@users')->name('api.group.users');
        Route::get('group/members/filter/{id}/{value}', 'API\V1\GroupController@filter')->name('api.group.filter');
        Route::post('group/members/add', 'API\V1\GroupController@addUsers')->name('api.group.addUsers');
        Route::get('group/members/group-users/{id}', 'API\V1\GroupController@getGroupUsersByGroup')->name('api.group.getGroupUsersByGroup');
        Route::post('group/members/remove', 'API\V1\GroupController@removeUsers')->name('api.group.removeUsers');
        Route::get('/group/all', 'API\V1\UserController@getAllGroup')->name('api.group.all');
        Route::get('/group/default', 'API\V1\UserController@getAllGroupDefault')->name('api.group.default');

        Route::get('clinic/{id}/user', 'API\V1\ClinicController@getUsers')->name('clinic.get.users');
        Route::post('clinic/{id}/user', 'API\V1\ClinicController@addUsers')->name('clinic.add.users');
        Route::get('clinic/all', 'API\V1\ClinicController@getAll')->name('api.clinic.all');

        Route::get('permission/list', 'API\V1\PermissionController@list')->name('permission.list');
        Route::get('permission/routes', 'API\V1\PermissionController@listRoutes')->name('permission.routes');

        Route::get('template/{id}', 'API\V1\TemplateController@show')->name('api.template.show');
        Route::delete('template/{id}', 'API\V1\TemplateController@destroy')->name('api.template.destroy');
        Route::get('template/', 'API\V1\TemplateController@index')->name('template.index');

        Route::get('request', 'API\V1\RequestController@index')->name('api.request.list');
        Route::get('request/{id}', 'API\V1\RequestController@show')->name('api.request.show');
        Route::post('request/{id}/status', 'API\V1\RequestController@changeStatus')->name('api.request.change_status');
        Route::post('request/{id}/comment', 'API\V1\RequestController@comment')->name('api.request.comment');
        Route::post('request/{id}', 'API\V1\RequestController@store')->name('api.request.store');

//        Route::get('inquiry', 'API\V1\InquiryController@index')->name('api.inquiry.list');
        Route::post('inquiry/{id}/close', 'API\V1\InquiryController@changeStatus')->name('api.inquiry.change_status');
        Route::post('inquiry/{id}/comment', 'API\V1\InquiryController@comment')->name('api.inquiry.comment');
        Route::post('inquiry/search', 'API\V1\InquiryController@search')->name('api.inquiry.search');

        Route::get('page/manual-latest', 'API\V1\PageController@manualLatest')->name('page.manualLatest');
        Route::post('page/upload-image-content', 'API\V1\PageController@uploadImageContent')->name('page.uploadImageContent');
        Route::put('page/{id}/change-status', 'API\V1\PageController@changeStatus')->name('page.changeStatus');
        Route::put('page/{id}/rating', 'API\V1\PageController@rating')->name('page.rating');
        Route::post('page/{id}', 'API\V1\PageController@update')->name('page.update');
        Route::post('category', 'API\V1\CategoryController@store')->name('category.store');

        Route::get('manager/roles', 'API\V1\AdminController@roles')->name('manager.roles');

        Route::apiResources([
            'user' => 'API\V1\UserController',
            'clinic' => 'API\V1\ClinicController',
            'inquiry' => 'API\V1\InquiryController',
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
Route::post('/password/reset', 'API\V1\Auth\ResetPasswordController@reset')->name('api.reset.password');
