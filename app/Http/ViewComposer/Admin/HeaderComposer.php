<?php

namespace App\Http\ViewComposer\Admin;

use Illuminate\Contracts\View\View;

use App\Models\BaseModel;

class HeaderComposer
{
	public function compose(View $view)
	{
		$view->with('header_user_super_admin', BaseModel::TYPE_USER_SUPER_ADMIN);
	}
}