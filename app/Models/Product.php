<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use SoftDeletes;

    protected $table    = 'products';

    protected $fillable = [
		// 
    ];

    protected $guarded  = [
		// 
    ];

    /**
     * products表单范围查询
     */
    public function scopeStatus($query)
    {
    	return $query->where('status', self::STATUS_NORMAL);
    }

    /**
     * 通过ID查询信息
     */
    public function get_product_by_id($id)
    {
    	return self::status()->find($id);
    }

    /**
     * 通过$cond条件查询信息
     */
    public function search_products()
    {
    	return self::status();
    }
}
