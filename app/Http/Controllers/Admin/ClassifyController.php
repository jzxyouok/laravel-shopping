<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Classify\Create;
use App\Http\Requests\Admin\Classify\Update;

use App\Services\Classify as sClassify;

use Request;

class ClassifyController extends BaseController
{
    /**
     * 分类主页面
     */
    public function index()
    {
        // 第一级分类
        $cond              = array();
        $cond['parent_id'] = 0;
        $cond['level']     = 0; 
        $cond['no_page']   = 0;
        $parent_classifies = sClassify::searchClassifies($cond);

        // 所有分类
        $cond              = array();
        $cond['no_page']   = 0;
        $all_classifies    = sClassify::searchClassifies($cond);

    	return view(self::BASE_ROUTE.'classifies.index', compact('parent_classifies', 'all_classifies'));
    }

    /**
     * 新增分类页面展示
     */
    public function create()
    {
    	$parent_id = Request::input('parent_id', 0);
        $level     = Request::input('level', 0);

        return view(self::BASE_ROUTE.'classifies.create', compact('parent_id', 'level'));
    }

    /**
     * 新增分类写入
     */
    public function store(Create $request)
    {
    	try {
    		$data = $request->all();

            sClassify::addNewClassify($data);

            return redirect()->route('admin.classify.index');
    	} catch(\Exception $e) {
    		return redirect()->route('admin.classify.index')->with('flash_message', '写入失败，请重新操作')->with('flash_type', 'danger');
    	}
    }

    /**
     * 编辑分类页面展示
     */
    public function edit($id)
    {
    	$classify = sClassify::getClassifyById($id);

        return view(self::BASE_ROUTE.'classifies.index', compact('classify'));
    }

    /**
     * 编辑分类写入
     */
    public function update(Update $request, $id)
    {
    	try {
    		$data = $request->all();

            sClassify::updateClassify($data, $id);

            return redirect()->route('admin.classify.index');
    	} catch(\Exception $e) {
    		return redirect()->route('admin.classify.index')->with('flash_message', '编辑失败，请重新操作')->with('flash_type', 'danger');
    	}
    }

    /**
     * 删除分类
     */
    public function destroy($id)
    {
    	try {
    		sClassify::deleteClassify($id);

            return redirect()->route('admin.classify.index');
    	} catch(\Exception $e) {
    		return redirect()->route('admin.classify.index')->with('flash_message', '删除失败，请重新操作')->with('flash_type', 'danger');
    	}
    }
}