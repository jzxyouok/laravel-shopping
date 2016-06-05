<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            // 订单类型（1：用户订单；2：其它）
            $table->tinyInteger('type')->default(1);
            // 订单编号
            $table->string('order_no');
            // 订单金额
            $table->decimal('amount', 25, 2)->unsigned();
            // 下单人
            $table->integer('user_id');
            // 商品
            $table->integer('product_id');
            $table->string('remark');
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
        Schema::drop('orders');
    }
}
