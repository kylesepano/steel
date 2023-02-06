<?php

use App\Models\machine;
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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        machine::create([
            'name' => 'Steel Decking Machine'
        ]);
        machine::create([
            'name' => 'Semi Automatic C Purlins Machine'
        ]);
        machine::create([
            'name' => 'Ceiling Machine'
        ]);
        machine::create([
            'name' => 'Tile Roof Machine'
        ]);
        machine::create([
            'name' => 'Spandrel Machine'
        ]);
        machine::create([
            'name' => 'Metal Furring Machine'
        ]);
        machine::create([
            'name' => 'Cut to Length Machine'
        ]);
        machine::create([
            'name' => 'Corrugated Roof Machine'
        ]);
        machine::create([
            'name' => 'Rib Type Roof Machine'
        ]);
         machine::create([
            'name' => 'Portable Slitting Machine'
        ]);
        machine::create([
            'name' => 'Floor Deck Machine'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machines');
    }
};
