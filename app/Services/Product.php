<?php

namespace App\Services;

use App\Models\Product as mProduct;

class Product extends BaseService
{
	/**
	 * 通过ID获取信息
	 */
	public static function getProductById($id)
	{
		return (new mProduct)->get_product_by_id($id);
	}

	/**
	 * 通过$cond条件获取信息
	 */
	public static function searchProducts($cond = array(), $page = 1, $size = 10)
	{
		$products = new mProduct();

		$products = $products->search_products();

		if(isset($cond['target_id'])) {
			$products->where('target_id', $cond['target_id']);
		}

		if(isset($cond['get_first'])) {
			return $products->first();
		}

		if(isset($cond['no_page'])) {
			return $products->get();
		}

		return $products->paginate($size, ['*'], $page);
	}

	/**
	 * 写入商品
	 */
	public static function addNewProduct($data = array())
	{
		$product = mProduct::create($data);

		return $product;
	}

	/**
	 * 编辑商品
	 */
	public static function updateProduct($data = array(), $id)
	{
		$product = self::getProductById($id);

		$product->update($data);

		return $product;
	}

	/**
	 * 删除商品
	 */
	public static function deleteProduct($id)
	{
		$product = mProduct::destroy($id);

		return $product;
	}
}