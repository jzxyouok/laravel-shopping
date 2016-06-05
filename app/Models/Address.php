<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends BaseModel
{
    use SoftDeletes;

    protected $table    = 'addresses';

    protected $fillable = [
		'type',
		'target_id',
		'country',
		'province',
		'city',
		'prefectrue',
		'town',
		'detail',
		'telphone',
		'consignee',
		'status',
    ];

    protected $guarded  = [
		// 
    ];

    /**
     * addresses表单范围查询
     */
    public function scopeStatus($query)
    {
    	return $query->where('status', self::STATUS_NORMAL);
    }

    /**
     * 通过ID查询信息
     */
    public function get_address_by_id($id)
    {
    	return self::status()->find($id);
    }

    /**
     * 通过$cond条件查询信息
     */
    public function search_addresses()
    {
    	return self::status();
    }
}
