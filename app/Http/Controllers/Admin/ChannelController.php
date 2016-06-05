<?php

namespace App\Http\Controllers\Admin;

use App\Models\Channel   as mChannel;
use App\Services\Channel as sChannel;
use Request, DB;

class ChannelController extends BaseController
{
    /**
     * 栏目主页面
     */
    public function index()
    {
    	return view(self::BASE_ROUTE.'channels.index');
    }

    /**
     * 新增栏目页面展示
     */
    public function create()
    {
        $parent_id = Request::input('parent_id', 0);
        $level     = Request::input('level', 0);

        // 获取父类栏目
        if($parent_id == 0) {
            $parent_channel = null;
        }else {
            $parent_channel = sChannel::getChannelById($parent_id);
        }

    	return view(self::BASE_ROUTE.'channels.create', compact('parent_id', 'level', 'parent_channel'));
    }

    /**
     * 新增栏目写入
     */
    public function store()
    {
        try {
            // 开启事务
            DB::beginTransaction();

        	$data = Request::all();
            // dd($data);

            sChannel::addNewChannel($data);

            // 提交事务
            DB::commit();

            return redirect()->route('admin.channel.index');
        } catch(Exception $e) {
            // 回滚事务
            DB::rollback();

            return redirect()->route('admin.channel.index');
        }
    }

    /**
     * 编辑栏目页面展示
     */
    public function edit($id)
    {
        $channel        = sChannel::getChannelById($id);

        // 获取父类栏目
        if($channel->parent_id == 0) {
            $parent_channel = null;
        }else {
            $parent_channel = sChannel::getChannelById($channel->parent_id);
        }

        return view(self::BASE_ROUTE.'channels.edit', compact('channel', 'parent_channel'));
    }

    /**
     * 编辑栏目写入
     */
    public function update($id)
    {
        try {
            $data = Request::all();

            $channel = sChannel::getChannelById($id);

            $channel->update($data);

            return redirect()->route('admin.channel.index');
        } catch(Exception $e) {
            return redirect()->route('admin.channel.index');
        }
    }

    /**
     * 删除栏目
     */
    public function destroy($id)
    {
        try {
            mChannel::destroy($id);

            return redirect()->route('admin.channel.index');
        } catch(Exception $e) {
            return redirect()->route('admin.channel.index');
        }
    }
}