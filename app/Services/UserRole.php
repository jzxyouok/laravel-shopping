<?php

namespace App\Services;

use App\Models\UserRole as mUserRole;

class UserRole extends BaseService
{
	/**
	 * 通过ID获取信息
	 */
	public static function getUserRoleById($id)
	{
		return (new mUserRole)->get_user_role_by_id($id);
	}

	/**
	 * 通过$cond条件获取信息
	 */
	public static function searchUserRoles($cond = array(), $page = 1, $size = 15)
	{
		$userRoles = new mUserRole();

		$userRoles = $userRoles->search_user_roles();

		if (isset($cond['user_id'])) {
			$userRoles = $userRoles->where('user_id', $cond['user_id']);
		}

		if (isset($cond['role_id'])) {
			$userRoles = $userRoles->where('role_id', $cond['role_id']);
		}

		if (isset($cond['get_first'])) {
			return $userRoles->first();
		}

		if (isset($cond['no_page'])) {
			return $userRoles->get();
		}

		return $userRoles->paginate($size, ['*'], $page);
	}

	/**
	 * 编辑用户权限
	 */
	public static function updateUserRole($data = array(), $id)
	{
		// 删除该用户的所有权限
		$cond            = array();
		$cond['user_id'] = $id;
		$cond['no_page'] = 0;
		$userRoles       = self::searchUserRoles($cond);

		foreach($userRoles as $userRole) {
			self::deleteUserRole($userRole->id);
		}

		// 写入用户权限
		foreach($data['roles'] as $role) {
		    mUserRole::create([
			    'user_id' => $id,
			    'role_id' => $role
	    	]);
		}
	}

	/**
	 * 删除用户权限
	 */
	public static function deleteUserRole($id)
	{
		$userRole = mUserRole::destroy($id);
	}
}