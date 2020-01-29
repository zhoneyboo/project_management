<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseholdPopulationBySourceOfDrinkingWatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('household_population_by_source_of_drinking_waters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source_of_drinking');
            $table->integer('magnitude');
            $table->decimal('proportion', 20, 2);
            $table->year('year');
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
        Schema::dropIfExists('household_population_by_source_of_drinking_waters');
    }
}
