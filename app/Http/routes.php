<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 后台
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
	// 登录
	Route::resource('login', 'LoginController');

	// 后台操作
	Route::group(['middleware' => 'auth'], function () {
		// 后台主页面
		Route::get('/', ['as' => 'admin.home', 'uses' => 'SiteController@index']);
		// 注销登录
		Route::get('logout', ['as' => 'admin.logout', 'uses' => 'SiteController@logout']);
    
		// 用户管理
		Route::resource('user', 'UserController');

		// 权限管理
		// Route::resource('role', 'RoleController');
		
		// 图片处理 
		Route::post('image/upload', ['as' => 'admin.image.upload', 'uses' => 'ImageController@upload']);
		Route::post('image/preview', ['as' => 'admin.image.preview', 'uses' => 'ImageController@preview']);


		// 用户权限关联
		Route::resource('userRole', 'UserRoleController');
		
		// 栏目管理
		Route::resource('channel', 'ChannelController');
		
		// 商品管理
		Route::resource('product', 'ProductController');

		// 订单管理
		Route::resource('order', 'OrderController');

		// 分类管理
		Route::resource('classify', 'ClassifyController');

		// 地址管理
		Route::resource('address', 'AddressController');

		// 文章管理
		Route::resource('article', 'ArticleController');
	});
});