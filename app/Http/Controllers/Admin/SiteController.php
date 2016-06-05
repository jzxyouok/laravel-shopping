<?php

namespace App\Http\Controllers\Admin;

use Auth;

class SiteController extends BaseController
{
    /**
     * 后台主页面展示
     */
    public function index()
    {
        // dd(\Auth::user());
    	return view(self::BASE_ROUTE.'index');
    }

    /**
     * 注销登录
     */
    public function logout()
    {
    	Auth::logout();

    	return redirect()->route('admin.login.index'); 
    }
}
