<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id');
            // 商品类别名称
            $table->string('title');
            // 商品类别描述
            $table->string('description');
            $table->integer('parent_id')->default(0);
            // 商品类别深度
            $table->tinyInteger('level')->default(0);
            // 商品类别子类数量
            $table->integer('child')->default(0);
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
        Schema::drop('product_types');
    }
}
