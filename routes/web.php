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

// 商品
Route::group(['prefix' => 'merchandise'], function(){
    // 商品清單檢視
    Route::get('/', 'MerchandiseController@merchandiseListPage');

    // 商品資料新增
    Route::get('/create', 'MerchandiseController@merchandiseCreateProcess')->middleware(['user.auth.admin']);

    // 商品管理清單檢視
    Route::get('/manage', 'MerchandiseController@merchandiseManageListPage')->middleware(['user.auth.admin']);

    // 指定商品
    Route::group(['prefix' => '{merchandise_id}'], function(){
        Route::group(['middleware' => ['user.auth.admin']], function(){
            // 商品單品編輯頁面檢視
            Route::get('/edit', 'MerchandiseController@merchandiseItemEditPage');

            // 商品單品資料修改
            Route::put('/', 'MerchandiseController@merchandiseItemUpdateProcess');
        });
        // 商品單品檢視
        Route::get('/', 'MerchandiseController@merchandiseItemPage');

        // 購買商品
        Route::post('/buy', 'MerchandiseController@merchandiseItemBuyProcess')->middleware(['user.auth']);
    });  
});

