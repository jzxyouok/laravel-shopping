<?php

use Illuminate\Database\Seeder;

use App\Models\User as mUser;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        mUser::create([
        	'type'       => 1,
		    'username'   => '断水流',
		    'password'   => '123asd',
		    'email'      => 'kelvin_512@sina.com',
		    'sex'        => 1,
		    'avatar_url' => 'http://wx.qlogo.cn/mmopen/CSiaVIq4v0ibqAh2Kyv2mr4O955IbqwH7JGkIDNXpUQ5Ro0LMlZYe9zJg1lKHqicnArp2APJFA7sfWvduyDxiabFiauCKTib8Wfib7k/0',
    	]);
    }
}
