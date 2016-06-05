<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // 用户类别（1：超级管理员；2：管理员；3：普通用户）
            $table->tinyInteger('type')->default(3);
            $table->string('username')->unique();
            $table->string('email');
            $table->string('password');
            $table->string('avatar_url');
            // 用户性别（0：女性；1：男性；2：保密）
            $table->string('sex')->default(2);
            // 最后登陆时间
            $table->timestamp('last_login_time')->nullable();
            // 状态常量
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
