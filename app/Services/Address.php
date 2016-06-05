<?php

namespace App\Services;

use App\Models\Address as mAddress;

class Address extends BaseService
{
	/**
	 * 通过ID获取信息
	 */
	public static function getAddressById($id)
	{
		return (new mAddress)->get_address_by_id($id);
	}

	/**
	 * 通过$cond条件获取信息
	 */
	public static function searchAddresses($cond = array(), $page = 1, $size = 10)
	{
		$addresses = new mAddress();

		$addresses = $addresses->search_addresses();

		if(isset($cond['get_first'])) {
			return $addresses->first();
		}

		if(isset($cond['no_page'])) {
			return $addresses->get();
		}

		return $addresses->paginate($size, ['*'], $page);
	}

	/**
	 * 新增地址
	 */
	public static function addNewAddress($data = array())
	{
		$address = mAddress::create($data);

		return $address;
	}

	/**
	 * 编辑地址
	 */
	public static function updateAddress($data = array(), $id)
	{
		$address = self::getAddressById($id);

		$address->update($data);

		return $address;
	}

	/**
	 * 删除地址
	 */
	public static function deleteAddress($id)
	{
		$address = mAddress::destroy($id);

		return $address;
	}
}