<?php

namespace App\Services;

use App\Models\Role as mRole;

class Role extends BaseService
{
	/**
	 * 通过ID获取信息
	 */
	public static function getRoleById($id)
	{
		return (new mRole)->get_role_by_id($id);
	}

	/**
	 * 通过$cond条件获取信息
	 */
	public static function searchRoles($cond = array(), $page = 1, $size = 15)
	{
		$roles = new mRole();

		$roles = $roles->search_roles();

		if(isset($cond['get_first'])) {
			return $roles->first();
		}

		if(isset($cond['no_page'])) {
			return $roles->get();
		}

		return $roles->paginate($size, ['*'], $page);
	}
}