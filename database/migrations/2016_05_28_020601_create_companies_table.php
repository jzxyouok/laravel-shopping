<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            // 公司类别
            $table->tinyInteger('type');
            // 公司名称
            $table->string('title');
            // 公司描述
            $table->string('description');
            // 公司网址
            $table->string('website');
            // 公司电话
            $table->bigInteger('telphone');  // 移动电话
            $table->string('fixed_phone');   // 固定电话
            // 公司传真
            $table->string('fax');
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
        Schema::drop('companies');
    }
}
