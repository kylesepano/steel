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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('raw_material')->nullable();
            $table->string('coil_type')->nullable();
            $table->string('bl_number')->nullable();
            $table->string('j_code')->nullable();
            $table->string('l_code')->nullable();
            $table->double('width')->nullable();
            $table->double('thickness')->nullable();
            $table->double('beginning_weight')->nullable();
            $table->double('beginning_length')->nullable();
            $table->string('type')->nullable();
            $table->string('color')->nullable();
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
        Schema::dropIfExists('raw_materials');
    }
};
