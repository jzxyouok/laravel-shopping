<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\Admin\Validator;

class Update extends Validator
{
    /**
     * 表单验证
     */
    public function rules()
    {
        return [
            'username'   => 'required|string',
            'email'      => 'required|email',
            'type'       => 'integer',
            'sex'        => 'required|integer',
            'avatar_url' => 'required|string',
        ];
    }
}
