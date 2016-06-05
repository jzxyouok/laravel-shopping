<?php

use Illuminate\Database\Seeder;

use App\Services\Channel as sChannel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	try {
	        DB::table('channels')->delete();
            
            // 开启事务
	        DB::beginTransaction();

	        $address = sChannel::addNewChannel($data = array(
			    'parent_id'   => 0,
			    'level'       => 0,
			    'title'       => '地址管理',
			    'description' => '地址管理',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'address.index',
			    'style'       => 'fa-send',
	    	));

	    	$order = sChannel::addNewChannel([
			    'parent_id'   => 0,
			    'level'       => 0,
			    'title'       => '订单管理',
			    'description' => '订单管理',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'order.index',
			    'style'       => 'fa-rmb',
    		]);

	    	$product = sChannel::addNewChannel([
			    'parent_id'   => 0,
			    'level'       => 0,
			    'title'       => '商品管理',
			    'description' => '商品管理',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'product.index',
			    'style'       => 'fa-gift',
    		]);

    		$product_all = sChannel::addNewChannel([
			    'parent_id'   => $product->id,
			    'level'       => 1,
			    'title'       => '所有商品',
			    'description' => '所有商品',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'product.index',
			]);

    		$product_all = sChannel::addNewChannel([
			    'parent_id'   => $product->id,
			    'level'       => 1,
			    'title'       => '添加商品',
			    'description' => '添加商品',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'product.create',
			]);

	    	$classify = sChannel::addNewChannel([
			    'parent_id'   => 0,
			    'level'       => 0,
			    'title'       => '分类管理',
			    'description' => '分类管理',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'classify.index',
			    'style'       => 'fa-sitemap',
    		]);

    		$classify_all = sChannel::addNewChannel([
			    'parent_id'   => $classify->id,
			    'level'       => 1,
			    'title'       => '所有分类',
			    'description' => '所有分类',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'classify.index',
			]);

			$classify_create = sChannel::addNewChannel([
			    'parent_id'   => $classify->id,
			    'level'       => 1,
			    'title'       => '添加分类',
			    'description' => '添加分类',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'classify.create',
			]);

	    	$user = sChannel::addNewChannel([
			    'parent_id'   => 0,
			    'level'       => 0,
			    'title'       => '用户管理',
			    'description' => '用户管理',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'user.index',
			    'style'       => 'fa-users',
    		]);

	    	$user_all = sChannel::addNewChannel([
			    'parent_id'   => $user->id,
			    'level'       => 1,
			    'title'       => '所有用户',
			    'description' => '所有用户',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'user.index',
    		]);

	    	$user_create = sChannel::addNewChannel([
			    'parent_id'   => $user->id,
			    'level'       => 1,
			    'title'       => '添加用户',
			    'description' => '添加用户',
			    'type'        => 1,
			    'is_sys'      => 1,
			    'route'       => 'user.create',
    		]);
            
            // 提交事务
	    	DB::commit();
        } catch (\Exception $e) {
        	// 回滚事务
        	DB::rollback();
        }
    }
}
