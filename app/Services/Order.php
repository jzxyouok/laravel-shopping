<?php

namespace App\Services;

use App\Models\Order as mOrder;

class Order extends BaseService
{
	/**
	 * 通过ID获取信息
	 */
	public static function getOrderById($id)
	{
		return (new mOrder)->get_order_by_id($id);
	}

	/**
	 * 通过$cond条件获取信息
	 */
	public static function searchOrders($cond = array(), $page = 1, $size = 10)
	{
		$orders = new mOrder();

		$orders = $orders->search_orders();

		if(isset($cond['get_first'])) {
			return $orders->first();
		}

		if(isset($cond['no_page'])) {
			return $orders->get();
		}

		return $orders->paginate($size, ['*'], $page);
	}

	/**
	 * 写入订单
	 */
	public static function addNewOrder($data = array()) 
	{
		$order = mOrder::create($data);

		return $order;
	}

	/**
	 * 编辑订单
	 */
	public static function updateOrder($data = array(), $id)
	{
		$order = self::getOrderById($id);

		$order->update($data);

		return $order;
	}

	/**
	 * 删除订单
	 */
	public static function deleteOrder($id)
	{
		$order = mOrder::destroy($id);

		return $order;
	}
}