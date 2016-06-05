<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            // 文章类别（1：常规；2：其它）
            $table->tinyInteger('type')->default(1);
            // 文章标题
            $table->string('title');
            // 文章描述
            $table->string('description');
            // 文章内容
            $table->text('content');
            // 文章作者
            $table->string('author');
            // 文章发布时间
            $table->timestamp('publish_at');
            // 文章点击量
            $table->integer('hits')->default(0);
            // 文章关联
            $table->integer('target_id');
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
        Schema::drop('articles');
    }
}