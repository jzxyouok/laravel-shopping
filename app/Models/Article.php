<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends BaseModel
{
    use SoftDeletes;

    protected $table    = 'articles';

    protected $fillable = [
		'type',
		'title',
		'description',
		'content',
		'author',
		'publish_at',
		'hits',
        'target_id',
		'status',
    ];

    protected $guarded  = [
		// 
    ];

    /**
     * articles表单获取器
     */
    public function getPushlishAtAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    /**
     * articles表单范围查询
     */
    public function scopeStatus($query)
    {
    	return $query->where('status', self::STATUS_NORMAL);
    }

    /**
     * 通过ID查询信息
     */
    public function get_article_by_id($id)
    {
    	return self::status()->find($id);
    }

    /**
     * 通过$cond条件查询信息
     */
    public function search_articles()
    {
    	return self::status();
    }
}
