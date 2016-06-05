<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends BaseModel
{
    use SoftDeletes;

    protected $table    = 'channels';

    protected $fillable = [
		'type',
		'title',
		'description',
		'parent_id',
		'route',
        'level',
        'child',
        'is_sys',
        'style',
		'status',
    ];

    protected $guarded  = [
		// 
    ];

    /**
     * channels表单范围查询
     */
    // 1. status
    public function scopeStatus($query)
    {
    	return $query->where('status', self::STATUS_NORMAL);
    }

    /**
     * 通过ID查询信息
     */
    public function get_channel_by_id($id)
    {
    	return self::status()->find($id);
    }

    /**
     * 通过$cond条件查询信息
     */
    public function search_channels()
    {
    	return self::status();
    }
}
