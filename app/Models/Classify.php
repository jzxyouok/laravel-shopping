<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Classify extends BaseModel
{
    use SoftDeletes;
    
    // 这里请原谅我调皮了，开始设计数据库时用的product_types便于理解，后来想了下还是用了claaify这个词，看起来高大上一点
    protected $table    = 'product_types';

    protected $fillable = [
		'title',
		'description',
		'parent_id',
		'level',
		'child',
		'status',
    ];

    protected $guarded  = [
		// 
    ];

    /**
     * product_types表单范围查询
     */
    public function scopeStatus($query)
    {
    	return $query->where('status', self::STATUS_NORMAL);
    }

    /**
     * 通过ID查询信息
     */
    public function get_classify_by_id($id)
    {
    	return self::status()->find($id);
    }

    /**
     * 通过$cond条件查询
     */
    public function search_classifies()
    {
    	return self::status();
    }
}
