<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseModel;
use App\Services\UserRole as sUserRole;

use Request, Auth;

class LoginController extends BaseController
{
    /**
     * 后台登录页面展示
     */
    public function index()
    {
    	return view(self::BASE_ROUTE.'login');
    }
    
    /**
     * 后台登录验证
     */
    public function store()
    {
    	$credentials = Request::only('username', 'password');
    	$remember    = Request::has('remember');

	    // 后台登录仅限管理员才能登录，这里需要往验证数组中再加一个用户类型验证
	    // 1. 超级管理员
	    $credentials['type'] = BaseModel::TYPE_USER_SUPER_ADMIN;

	    if (Auth::attempt($credentials, $remember)) {
	    	return redirect()->route('admin.home');
	    }
        
        // 2. 管理员
	    $credentials['type'] = BaseModel::TYPE_USER_ADMIN;

        if (Auth::attempt($credentials, $remember)) {
	    	return redirect()->route('admin.home');
	    }

	    return redirect()->back();
    }
}
