<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            // 地址类别（1：用户地址；2：其它）
            $table->tinyInteger('type')->default(1);
            // 关联ID
            $table->integer('target_id');
            // 国家
            $table->string('country')->default('中国');
            // 省份
            $table->string('province');
            // 市
            $table->string('city');
            // 县或区
            $table->string('prefecture');
            // 镇
            $table->string('town')->nullable();
            // 详细地址
            $table->string('detail');
            $table->bigInteger('telphone');
            // 收货人
            $table->string('consignee');
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
        Schema::drop('addresses');
    }
}
