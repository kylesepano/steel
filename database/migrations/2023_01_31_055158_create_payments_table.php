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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_confirmation_id')->nullable();
            $table->date('date_received')->nullable();
            $table->double('amount_paid')->nullable();
            $table->double('remaining_payable')->nullable();
            $table->integer('mode')->nullable();
            $table->integer('bank_id')->nullable();
            $table->string('bank')->nullable();
            $table->string('check_number')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
