<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends BaseModel
{
    use SoftDeletes;

    protected $table    = 'user_roles';

    protected $fillable = [
		'user_id',
        'role_id',
        'status',
    ];

    protected $guarded  = [
		// 
    ];

    /**
     * user_roles表单范围查询
     */
    // 1. status
    public function scopeStatus($query)
    {
    	return $query->where('status', self::STATUS_NORMAL);
    }

    /**
     * user_roles表单关联查询
     */
    public function hasOneRole()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    /**
     * 通过ID查询信息
     */
    public function get_user_role_by_id($id)
    {
    	return self::status()->find($id);
    }

    /**
     * 通过$cond条件查询信息
     */
    public function search_user_roles()
    {
    	return self::status();
    }
}
