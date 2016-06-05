<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends BaseModel
{
    use SoftDeletes;

    protected $table    = 'orders';

    protected $fillable = [
		'type',
		'order_no',
		'amount',
		'user_id',
		'product_id',
		'remark',
		'status',
    ];

    protected $guarded  = [
		// 
    ];

    /**
     * orders表单范围查询
     */
    public function scopeStatus($query)
    {
    	return $query->where('status', self::STATUS_NORMAL);
    }

    /**
     * 通过ID查询信息
     */
    public function get_order_by_id($id)
    {
    	return self::status()->find($id);
    }

    /**
     * 通过$cond条件查询信息
     */
    public function search_orders()
    {
    	return self::status();
    }
}
