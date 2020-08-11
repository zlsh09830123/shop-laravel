<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 使用者
Route::group(['prefix' => 'user'], function(){
    // 使用者驗證
    Route::group(['prefix' => 'auth'], function(){
        // 使用者註冊頁面
        Route::get('/sign-up', 'UserAuthController@signUpPage');

        // 使用者資料新增
        Route::post('/sign-up', 'UserAuthController@signUpProcess');

        // 使用者登入頁面
        Route::get('/sign-in', 'UserAuthController@signInPage');

        // 使用者登入處理
        Route::post('/sign-in', 'UserAuthController@signInProcess');

        // 使用者登出
        Route::get('/sign-out', 'UserAuthController@signOut');
    });
});
