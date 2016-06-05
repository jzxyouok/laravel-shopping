<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\BaseModel;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
		'type',
		'username',
		'email',
		'password',
		'avatar_url',
		'sex',
		'last_login_time',
		'status',
    ];

    protected $guarded  = [
		// 
    ];

    protected $hidden   = [
		'password',
		'remember_token',
    ];

    // 常量转换
    public static $user_column = [
        BaseModel::TYPE_USER_SUPER_ADMIN => '超级管理员',
        BaseModel::TYPE_USER_ADMIN       => '管理员',
        BaseModel::TYPE_USER_NORMAL      => '普通用户',
    ];

    /**
     * users表单获取器
     */
    // 1. password字段（密码加密处理）
    public function setPasswordAttribute($value)
    {
    	$this->attributes['password'] = \Hash::make($value);
    }

    /**
     * users表单范围查询
     */
    // 1. status
    public function scopeStatus($query)
    {
    	return $query->where('status', BaseModel::STATUS_NORMAL);
    }

    /**
     * users表单关联查询
     */
    public function hasManyUserRoles()
    {
        return $this->hasMany('App\Models\UserRole', 'user_id', 'id');
    }

    /**
     * 通过ID查询信息
     */
    public function get_user_by_id($id)
    {
        return self::status()->find($id);
    }

    /**
     * 通过$cond条件查询信息
     */
    public function search_users()
    {
        return self::status()->with('hasManyUserRoles.hasOneRole');
    }
}
