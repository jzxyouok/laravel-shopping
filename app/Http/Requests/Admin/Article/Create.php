<?php

namespace App\Http\Requests\Admin\Article;

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
            'content'     => 'required|string',
            'author'      => 'required|string',
            'publish_at'  => 'required|date',
        ];
    }
}
