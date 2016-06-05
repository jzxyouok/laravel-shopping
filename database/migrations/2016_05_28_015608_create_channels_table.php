<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');
            // 栏目类别（1：组织；2：列表；3：文章）
            $table->tinyInteger('type');
            // 栏目标题
            $table->string('title');
            // 栏目描述
            $table->string('description');
            $table->integer('parent_id')->default(0);
            // 栏目路由
            $table->string('route');
            // 栏目深度
            $table->tinyInteger('level')->default(0);
            // 栏目下属数目
            $table->integer('child')->default(0);
            // 是否属于系统（即需要新建表单支持的功能，默认为非系统。1：系统；2：非系统）
            $table->tinyInteger('is_sys')->default(2);
            // 样式（just for fun，不用在意）
            $table->string('style')->default('fa-files-o');
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
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
        Schema::drop('channels');
    }
}
