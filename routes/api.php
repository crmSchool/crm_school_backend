<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 *  Routes for Authentication
 */

Route::group([
    'prefix' => 'auth',
    'as' => 'auth'
], function(){
    Route::post('', ['as' => '', 'uses' => 'Auth\AuthController@authenticate']);
    Route::post('register', ['as' => 'register', 'uses' => 'Auth\AuthController@register']);
    Route::post('reset_password', ['as' => 'resetPassword', 'uses' => 'Auth\AuthController@resetPassword']);
    Route::get('change_password/{token}', ['as' => 'changePassword', 'uses' => 'Auth\AuthController@changePassword']);
    Route::get('refresh_token', ['as' => 'refresh', 'uses' => 'Auth\AuthController@refresh']);
});

/**
 *  Authenticated routes
 */

Route::group([
    'middleware' => ['jwt_auth'],
], function(){

    /**
     *  Routes for users account
     */
    
    Route::group([
        'prefix' => 'account',
        'as' => 'account'
    ], function() {
        Route::get('', ['as' => 'index', 'uses' => 'AccountController@index']);
    });
    
    /**
     *
     *  Routes for permissions
     *
     */

    Route::group([
        'prefix' => 'permissions',
        'as' => 'permissions'
    ], function(){
        Route::get('', ['as' => 'index', 'uses' => 'PermissionController@index']);
        Route::get('roles', ['as' => 'roles.index', 'uses' => 'PermissionController@roles_permissions']);
        Route::post('', ['as' => 'update', 'uses' => 'PermissionController@update']);
    });

    /**
     *
     *  Routes for oles
     *
     */

    Route::group([
        'prefix' => 'roles',
        'as' => 'role'
    ], function(){
        Route::get('', ['as' => 'index', 'uses' => 'RoleController@index']);
    });
});
