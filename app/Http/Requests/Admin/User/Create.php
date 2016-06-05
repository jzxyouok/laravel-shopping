<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\Admin\Validator;

class Create extends Validator
{
    /**
     * 表单验证
     */
    public function rules()
    {
        return [
            'username'   => 'required|string',
            'email'      => 'required|email',
            'type'       => 'required|integer',
            'sex'        => 'required|integer',
            'password'   => 'required|confirmed',
            'avatar_url' => 'required|string',
        ];
    }
}
