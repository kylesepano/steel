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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('length_dependent')->nullable();
            $table->integer('purlin')->nullable();
            $table->integer('standard_length')->nullable();
            $table->integer('special_cut')->nullable();
            $table->integer('production_process')->nullable();
            $table->integer('bended_accessory')->nullable();
            $table->string('uom')->nullable();
            $table->integer('color')->nullable();
            $table->integer('machine_id')->nullable();
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
        Schema::dropIfExists('products');
    }
};
