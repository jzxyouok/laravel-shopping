<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Product\Create;
use App\Http\Requests\Admin\Product\Update;

use App\Services\Product as sProduct;

use Request;

class ProductController extends BaseController
{
    /**
     * 商品主页面
     */
    public function index()
    {
        $cond            = array();
        $cond['no_page'] = 0;
        $products        = sProduct::searchProducts($cond);

    	return view(self::BASE_ROUTE.'products.index', compact('products'));
    }

    /**
     * 新增商品页面展示
     */
    public function create()
    {
    	return view(self::BASE_ROUTE.'products.create');
    }

    /**
     * 新增商品写入
     */
    public function store(Create $request)
    {
    	try {
    		$data = $request->all();

            sProduct::addNewProduct($data);

            return redirect()->route('product.index');
    	} catch(\Exception $e) {
    		return redirect()->route('product.index')->with('flash_message', '写入失败，请重新操作')->with('flash_type', 'danger');
    	}
    }

    /**
     * 编辑商品页面展示
     */
    public function edit($id)
    {
        $product = sProduct::getProductById($id);

    	return view(self::BASE_ROUTE.'products.edit', compact('product'));
    }

    /**
     * 编辑商品写入
     */
    public function update(Update $request, $id)
    {
    	try {
    		$data = $request->all();

            sProduct::updateProduct($data, $id);

            return redirect()->route('product.index');
    	} catch(\Exception $e) {
    		return redirect()->route('product.index')->with('flash_message', '编辑失败，请重新操作')->with('flash_type', 'danger');
    	}
    }

    /**
     * 删除商品
     */
    public function destroy($id)
    {
    	try {
    		sProduct::deleteProduct($id);

            return redirect()->route('product.index');
    	} catch(\Exception $e) {
    		return redirect()->route('product.index')->with('flash_message', '删除失败，请重新操作')->with('flash_type', 'danger');
    	}
    }
}