<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('brand_id');
            $table->text('s_description');
            $table->float('purchase_price', 10,2);
            $table->float('sell_price', 10,2);
            $table->float('re_sell_price', 10,2);
            $table->integer('qty')->default('0');
            $table->tinyInteger('status');
            $table->text('featured_image');
            $table->text('slider_image');
            $table->text('l_description'); 
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
        Schema::dropIfExists('items');
    }
};
