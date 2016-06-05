<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserRole as sUserRole;

use Request, DB;

class UserRoleController extends BaseController
{
    /**
     * 编辑用户权限写入
     */
    public function update($id)
    {
    	try {
    		// 开启事务
    		DB::beginTransaction();

    		$data = Request::all();

    		sUserRole::updateUserRole($data, $id);
            
            // 提交事务
    		DB::commit();

    		return redirect()->route('admin.user.index');
    	} catch (\Exception $e) {
    		// 回滚事务
    		DB::rollback();

    		return redirect()->route('admin.user.index');
    	}
    }
}
