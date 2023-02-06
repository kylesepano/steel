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
        Schema::create('inquiry_products', function (Blueprint $table) {
            $table->id();
            $table->integer('inquiry_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('product_variation_id')->nullable();
            $table->double('length')->nullable();
            $table->string('color')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('price_piece')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('inquiry_products');
    }
};
