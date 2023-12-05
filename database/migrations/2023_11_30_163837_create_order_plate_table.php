<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_plate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('plate_id');
            $table->integer('quantity');
            $table->timestamps();

            // Definizione delle chiavi esterne
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('plate_id')->references('id')->on('plates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_plate');
    }
};