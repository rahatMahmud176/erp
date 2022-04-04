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
        Schema::create('deliveri_agent_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id');
            $table->integer('sell_id');
            $table->string('challan');
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
        Schema::dropIfExists('deliveri_agent_details');
    }
};
