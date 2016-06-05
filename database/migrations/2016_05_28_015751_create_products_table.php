<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            // 商品名称
            $table->string('title');
            // 商品描述
            $table->string('description');
            // 商品价格
            $table->decimal('price', 25, 2)->unsigned();
            // 商品折扣
            $table->decimal('discount', 3, 2)->unsigned()->default(1);
            // 是否新品（0：不是新品；1：新品）
            $table->tinyInteger('is_new')->default(0);
            // 是否热销（0：不是热销：1：热销）
            $table->tinyInteger('is_hot')->default(0);
            // 是否上架（0：下架；1：上架）
            $table->tinyInteger('is_sale')->default(0);
            // 关联ID
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
        Schema::drop('products');
    }
}
