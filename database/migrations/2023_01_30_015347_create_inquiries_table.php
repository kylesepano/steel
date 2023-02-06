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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('purpose')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('discount_type')->nullable();
            $table->double('discount_amount')->nullable();
            $table->integer('status')->nullable();
            $table->string('notes')->nullable();
            $table->string('job_order_id')->nullable();
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
        Schema::dropIfExists('inquiries');
    }
};
