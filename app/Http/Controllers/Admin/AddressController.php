<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Address\Create;
use App\Http\Requests\Admin\Address\Update;

use App\Services\Address as mAddress;

use Request;

class AddressController extends BaseController
{
    /**
     * 地址主页面
     */
    public function index()
    {
    	// 
    }

    /**
     * 新增地址页面展示
     */
    public function create()
    {
    	// 
    }

    /**
     * 新增地址写入
     */
    public function store(Create $request)
    {
    	try {
    		// 
    	} catch(\Exception $e) {
    		// 
    	}
    }

    /**
     * 编辑地址页面展示
     */
    public function edit($id)
    {
    	// 
    }

    /**
     * 编辑地址写入
     */
    public function update(Update $request, $id)
    {
    	try {
    		// 
    	} catch(\Exception $e) {
    		// 
    	}
    }

    /**
     * 删除地址
     */
    public function destroy($id)
    {
    	try {
    		// 
    	} catch(\Exception $e) {
    		// 
    	}
    }
}