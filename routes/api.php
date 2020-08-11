<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', function (Request $request) {
        dd(123);
        return $request->user();
    });
    Route::group(['name' => 'permission'], function () {
        
    });

    Route::group(['name' => 'api.', 'middleware' => 'check.permission'], function () {
        
        Route::get('profile', 'API\V1\ProfileController@profile');
        Route::put('profile', 'API\V1\ProfileController@updateProfile');
        Route::post('change-password', 'API\V1\ProfileController@changePassword');
        Route::get('tag/list', 'API\V1\TagController@list');
        Route::get('category/list', 'API\V1\CategoryController@list');
        Route::post('product/upload', 'API\V1\ProductController@upload')->name('product.upload');

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
            'role' => 'API\V1\TagController',
            'permission' => 'API\V1\PermissionController'            
        ]);

        // Route::resource('blog', 'API\V1\BlogController', [
        //     'names' => [
        //         'index' => 'blog.list',
        //         'storage' => 'Create',
        //         'show' => 'Show',
        //         'update' => 'Update',
        //         'destroy' => 'Delete'
        //     ],                       
        // ]);
        
        // Route::resource('manager', 'API\V1\AdminController', [
        //     'names' => [
        //         'index' => 'View list',
        //         'storage' => 'Create',
        //         'show' => 'Show',
        //         'update' => 'Update',
        //         'destroy' => 'Delete'
        //     ]
        // ]);

        // Route::resource('role', 'API\V1\RoleController', [
        //     'names' => [
        //         'index' => 'View list',
        //         'storage' => 'Create',
        //         'show' => 'Show',
        //         'update' => 'Update',
        //         'destroy' => 'Delete'
        //     ]
        // ]);

        // Route::resource('permission', 'API\V1\PermissionController', [
        //     'names' => [
        //         'index' => 'View list',
        //         'storage' => 'Create',
        //         'show' => 'Show',
        //         'update' => 'Update',
        //         'destroy' => 'Delete'
        //     ]
        // ]);

    });
    
});


Route::post('/login', 'API\V1\LoginController@login')->name('login_api');
