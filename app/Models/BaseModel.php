<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	const ADDRESS_CONTROL       = 1;     // 地址管理
	const ORDER_CONTROL　　　　　= 2;     // 订单管理
	const PRODUCT_CONTROL       = 3;     // 商品管理
	const CLASSIFY_CONTROL      = 4;     // 分类管理
	const USER_CONTROL          = 5;     // 用户管理

    const TYPE_USER_SUPER_ADMIN = 1;     // 超级管理员
    const TYPE_USER_ADMIN       = 2;     // 管理员
    const TYPE_USER_FAKER       = 3;     // 马甲用户
    const TYPE_USER_NORMAL      = 4;     // 普通用户


    const STATUS_NORMAL         = 1;     // 查询常量

    const TYPE_ARTICLE_NORMAL   = 1;     // 常规文章

    const IMAGE_BASE_PATH       = 'images/upload';  // 图片上传存放的基本路径
}
