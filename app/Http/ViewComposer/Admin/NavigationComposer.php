<?php

namespace App\Http\ViewComposer\Admin;

use Illuminate\Contracts\View\View;

use App\Models\BaseModel;
use App\Services\Channel  as sChannel;
use App\Services\UserRole as sUserRole;

class NavigationComposer
{
	public function compose(View $view)
	{
        // 获取登录管理员的权限
        $id = \Auth::user()->id;
        
        $cond            = array();
        $cond['user_id'] = $id;
        $cond['no_page'] = 0;
        $roles           = sUserRole::searchUserRoles($cond);
        
        $left_user_roles = array();
        foreach($roles as $role) {
            $left_user_roles[] = $role->role_id;
        }

		// 导航栏第一级栏目
		// 作一个限定，以用户权限作限定
		$cond                 = array();
		$cond['parent_id']    = 0;
		$cond['level']        = 0;
		$cond['no_page']      = 0;
		$left_parent_channels = sChannel::searchChannels($cond);

		foreach($left_parent_channels as $key => $left_parent_channel) {
			if($left_parent_channel->is_sys == 1 && \Auth::user()->type != BaseModel::TYPE_USER_SUPER_ADMIN) {
			    if(!in_array($left_parent_channel->id, $left_user_roles)) {
			    	unset($left_parent_channels[$key]);
			    }
			}
		}

		// 导航栏所有栏目
		$cond                 = array();
		$cond['no_page']      = 0;
		$left_all_channels    = sChannel::searchChannels($cond);

		foreach($left_parent_channels as $left_parent_channel) {
			$left_parent_channel->subs = get_subs($left_all_channels, $left_parent_channel->id);
		}

		// dd($left_parent_channels);

		$view->with('left_parent_channels', $left_parent_channels)->with('left_user_roles', $left_user_roles)->with('user_super_admin', BaseModel::TYPE_USER_SUPER_ADMIN)->with('user_admin', BaseModel::TYPE_USER_ADMIN)->with('article_normal', BaseModel::TYPE_ARTICLE_NORMAL);
	}
}