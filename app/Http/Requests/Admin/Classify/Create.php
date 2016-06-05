<?php

namespace App\Http\Requests\Admin\Classify;

use App\Http\Requests\Admin\Validator;

class Create extends Validator
{
    /**
     * 表单验证
     */
    public function rules()
    {
        return [
            'title'       => 'required|string',
            'description' => 'required|string',
            'parent_id'   => 'required|integer',
            'level'       => 'required|integer',
        ];
    }
}
