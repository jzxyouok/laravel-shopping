<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\User\Create;
use App\Http\Requests\Admin\User\Update;

use App\Models\BaseModel;
use App\Models\User      as mUser;
use App\Services\User    as sUser;
use App\Services\Role    as sRole;
use App\Services\Channel as sChannel;

use Request;

class UserController extends BaseController
{
    /**
     * 用户主页面
     */
    public function index()
    {
    	$cond            = array();
    	$users           = sUser::searchUsers($cond);

    	$cond            = array();
    	$cond['no_page'] = 0;
    	$roles           = sRole::searchRoles($cond);

    	$roles = select_format($roles, 'id', 'title');

        // 获取用户对应栏目信息，便于页面层次的清晰
        $channel_id      = Request::input('channel_id', 1);
        // $channel         = sChannel::getChannelById($channel_id);
        $cond            = array();
        $cond['no_page'] = 0;
        $all_channels    = sChannel::searchChannels($cond);

        $parent_channels = get_parents($all_channels, $channel_id);

    	return view(self::BASE_ROUTE.'users.index', compact('users', 'roles', 'parent_channels'));
    }

    /**
     * 新增用户页面展示
     */
    public function create()
    {
    	return view('admin.users.create');
    }

    /**
     * 新增用户写入
     */
    public function store(Create $request)
    {
    	try {
    		$data = $request->all();

    		$user = sUser::addNewUser($data);

    		return redirect()->route('admin.user.index');
    	} catch(\Exception $e) {
    		return redirect()->route('admin.user.index');
    	}
    }

    /**
     * 编辑用户页面展示
     */
    public function edit($id)
    {
    	$user = sUser::getUserById($id);

    	return view('admin.users.edit', compact('user'));
    }

    /**
     * 编辑用户写入
     */
    public function update(Update $request, $id)
    {
    	try {
    		$data = $request->all();

    		$user = sUser::updateUser($data, $id);

    		return redirect()->route('admin.user.index');
    	} catch(\Exception $e) {
    		return redirect()->route('admin.user.index');
    	}
    }

    /**
     * 删除用户
     */
    public function destroy($id)
    {
    	try {
	    	$user = sUser::deleteUser($id);

	    	return redirect()->route('admin.user.index');
    	} catch(\Exception $e) {
    		return redirect()->route('amdin.user.index');
    	}
    }
}
