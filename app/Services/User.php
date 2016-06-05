<?php

namespace App\Services;

use App\Models\User as mUser;

class User extends BaseService
{
	/**
	 * 通过ID获取信息
	 */
	public static function getUserById($id)
	{
		return (new mUser)->get_user_by_id($id);
	}

	/**
	 * 通过$cond条件获取信息
	 */
	public static function searchUsers($cond = array(), $page = 1, $size = 10)
	{
		$users = new mUser();

		$users = $users->search_users();
        
	    if(isset($cond['get_first'])) {
	    	return $users->first();
	    }

		if(isset($cond['no_page'])) {
			return $users->get();
		}

		return $users->paginate($size, ['*'], $page);
	}

	/**
	 * 新增用户
	 */
	public static function addNewUser($data = array())
	{
		$user = mUser::create($data);

		return $user;
	}

	/**
	 * 编辑用户
	 */
	public static function updateUser($data = array(), $id)
	{
		$user = self::getUserById($id);

		$user->udpate($data);

		return $user;
	}

	/**
	 * 删除用户
	 */
	public static function deleteUser($id)
	{
		$user = mUser::destroy($id);

		return $user;
	}
}