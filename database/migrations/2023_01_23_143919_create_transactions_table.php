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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->unsigned();
            $table->bigInteger('buyer_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
