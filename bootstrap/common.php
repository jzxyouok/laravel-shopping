<?php

/**
 * 无限级分类之取出某一类别的所有子类
 */
function get_subs($data = array(), $id)
{
	$result = array();

	foreach ($data as $value) {
		if ($value['parent_id'] == $id) {
			$result[] = $value;
			$result   = array_merge($result, get_subs($data, $value['id']));
		}
	}

	return $result; 
}

/**
 * 无限级分类之取出某一类别的所有父类
 */
function get_parents($data = array(), $id)
{
	$result = array();

	foreach($data as $value) {
		if($value['id'] == $id) {
			$result[] = $value;
			$result   = array_merge($result, get_parents($data, $value['parent_id']));
			break;
		}
	}

	return $result;
}

/**
 * 选取数组中的一个字段的值作键名，另一字段的值做键值
 */
function select_format($data = array(), $key1 = 'id', $key2 = '')
{
	$result = array();

	foreach($data as $value) {
		$result[$value[$key1]] = $value[$key2]; 
	}

	return $result;
}

/**
 * 视图共享视图路径转化
 */
function view_change($route, $prefix = 'admin')
{
	$result   = array();
	$result[] = $prefix.'.'.$route.'.index';
	$result[] = $prefix.'.'.$route.'.show';
	$result[] = $prefix.'.'.$route.'.create';
	$result[] = $prefix.'.'.$route.'.edit';

	return $result;
}