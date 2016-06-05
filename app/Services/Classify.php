<?php

namespace App\Services;

use App\Models\Classify as mClassify;

class Classify extends BaseService
{
	/**
	 * 通过ID获取信息
	 */
	public static function getClassifyById($id)
	{
		return (new mClassify)->get_classify_by_id($id);
	}

	/**
	 * 通过$cond条件获取信息
	 */
	public static function searchClassifies($cond, $page = 1, $size = 10)
	{
		$classifies = new mClassify();

		$classifies = $classifies->search_classifies();

		if(isset($cond['parent_id'])) {
			$classifies = $classifies->where('parent_id', $cond['parent_id']);
		}

		if(isset($cond['level'])) {
			$classifies = $classifies->where('level', $cond['level']);
		}

		if(isset($cond['get_first'])) {
			return $classifies->first();
		}

		if(isset($cond['no_page'])) {
			return $classifies->get();
		}

		return $classifies->paginate($size, ['*'], $size);
	}

	/**
	 * 写入分类
	 */
	public static function addNewClassify($data = array())
	{
		$classify = mClassify::create($data);

		// 写入分类的同时，将该分类的上一级child字段加一，如果为第一级分类，则不加
		$parent_classify = self::getClassifyById($classify->parent_id);

		if($parent_classify->parent_id != 0) {
			$parent_classify->child += 1;
			$parent_classify->save();
		}

		return $classify;
	}

	/**
	 * 编辑分类
	 */
	public static function updateClassify($data = array(), $id)
	{
		$classify = self::getClassifyById($id);

		$classify->update($data);

		return $classify;
	}

	/**
	 * 删除分类
	 */
	public static function deleteClassify($id)
	{
		$classify = mClassify::destroy($id);

		return $classify;
	}
}