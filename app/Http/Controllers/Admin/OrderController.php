<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Order\Create;
use App\Http\Requests\Admin\Order\Update;

use App\Services\Order as sOrder;

use Request, DB;

class OrderController extends BaseController
{
    /**
     * 订单主页面
     */
    public function index()
    {
        $cond            = array();
        $cond['no_page'] = 0;
    	$orders          = sOrder::searchOrders($cond);

        // 订单管理这里取出全部数据给前台页面渲染，由于前台table表格用dataTables插件优化，使用AJAX异步请求数据虽然能加快刷新速度，但是给后台服务端处理略显麻烦，后台此时数据格式已经确定，查询方式已经固定，再改就有点麻烦了。
        // 如果数据量少于10000条，还是这样做，更简洁，更便于理解，如果数据量大于10000条，再令说
        // 其实我是有点不懂，也有点懒去做这个。还要加路由，加其它的，真是有点麻烦

        return view(self::BASE_ROUTE.'orders.index', compact('orders'));
    }

    /**
     * 新增订单页面展示
     */
    public function create()
    {
    	// 
    }

    /**
     * 新增订单写入
     */
    public function store(Create $request)
    {
    	try {
    		// 
    	} catch(\Exception $e) {
    		// 
    	}
    }

    /**
     * 编辑订单页面展示
     */
    public function edit($id)
    {
    	// 
    }

    /**
     * 编辑订单写入
     */
    public function update(Update $request, $id)
    {
    	try {
    		// 
    	} catch(\Exception $e) {
    		// 
    	}
    }

    /**
     * 删除订单
     */
    public function destroy($id)
    {
    	try {
    		// 
    	} catch(\Exception $e) {
    		// 
    	}
    }
}