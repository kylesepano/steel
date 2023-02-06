<?php

use App\Models\branch;
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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        branch::create([
            'name' => 'Cagayan de Oro'
        ]);
        branch::create([
            'name' => 'El Salvador'
        ]);
        branch::create([
            'name' => 'Davao'
        ]);
        branch::create([
            'name' => 'Maramag'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
};
