<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrbanRuralPopulationInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urban_rural_population_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->year('population_year_1');
            $table->year('population_year_2');
            $table->year('year_of_encoding');
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
        Schema::dropIfExists('urban_rural_population_infos');
    }
}
