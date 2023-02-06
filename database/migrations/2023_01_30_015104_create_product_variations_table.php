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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->double('length')->nullable();
            $table->string('length_uom')->nullable();
            $table->double('width')->nullable();
            $table->string('width_uom')->nullable();
            $table->double('height')->nullable();
            $table->string('height_uom')->nullable();
            $table->double('thickness')->nullable();
            $table->string('thickness_uom')->nullable();
            $table->double('weight_pc')->nullable();
            $table->double('weight_meter')->nullable();
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
        Schema::dropIfExists('product_variations');
    }
};
