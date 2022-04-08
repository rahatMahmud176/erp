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
        Schema::create('supplier_pay_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id');
            $table->integer('stock_id')->nullable();
            $table->integer('sell_id')->nullable();
            $table->integer('cash_id')->nullable();
            $table->integer('account_id')->nullable(); 
            $table->string('date');
            $table->float('amount', 10,2);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('supplier_pay_details');
    }
};
