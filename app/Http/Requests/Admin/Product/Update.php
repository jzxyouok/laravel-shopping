<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\Admin\Validator;

class Update extends Validator
{
    /**
     * 表单验证
     */
    public function rules()
    {
        return [
            'title'       => 'required|string',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0|regex:/^\d+(\.\d{0,2})?$/',
            'discount'    => 'required|numeric|min:0|max:1|regex:/^\d+(\.\d{0,2})?$/',
            'is_new'      => 'accepted',
            'is_hot'      => 'accepted',
            'is_sale'     => 'accepted',
        ];
    }
}
