<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class Validator extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }
}
