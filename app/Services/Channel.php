<?php

namespace App\Services;

use App\Models\Channel as mChannel;
use App\Models\Role    as mRole;

class Channel extends BaseService
{
	/**
	 * 通过ID获取信息
	 */
	public static function getChannelById($id)
	{
		return (new mChannel)->get_channel_by_id($id);
	}

	/**
	 * 通过$cond条件获取信息
	 */
	public static function searchChannels($cond = array(), $page = 1, $size = 15)
	{
		$channels = new mChannel();

		$channels = $channels->search_channels();

		if (isset($cond['parent_id'])) {
			$channels = $channels->where('parent_id', $cond['parent_id']);
		}

		if (isset($cond['level'])) {
			$channels = $channels->where('level', $cond['level']);
		}

		if (isset($cond['get_first'])) {
			return $channels->first();
		}

		if (isset($cond['no_page'])) {
			return $channels->get();
		}

		return $channels->paginate($size, ['*'], $page);
	}

	/**
	 * 新增栏目
	 */
	public static function addNewChannel($data = array())
	{
		if($data['type'] == 2) {
			$data['route'] = 'article.index';
		}elseif($data['type'] == 3) {
			$data['route'] = 'article.create';
		}
		
		$channel = mChannel::create($data);

		// 新增栏目的同时让其上一级的child字段加1
		if($channel->parent_id > 0) {
			$parent_channel = self::getChannelById($channel->parent_id);

			$parent_channel->child += 1;
			$parent_channel->save();
		}

		// 如果新增栏目为系统栏目，且为第一级栏目，则将数据写入roles表单，作权限判断
		if($channel->is_sys == 1 && $channel->parent_id == 0) {
			$role_data['title']       = $channel->title;
			$role_data['description'] = $channel->description;
			$role_data['target_id']   = $channel->id;

			mRole::create($role_data);
		}

		return $channel;
	}
}