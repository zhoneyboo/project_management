<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrbanRuralPopulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urban_rural_populations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('urban_rural_population_infos_id');
            
            $table->integer('municipality');
            $table->integer('no_of_barangays_urban');
            $table->integer('no_of_barangays_rural');

            $table->integer('population_urban_year_1');
            $table->integer('population_rural_year_1');

            $table->integer('population_urban_year_2');
            $table->integer('population_rural_year_2');

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
        Schema::dropIfExists('urban_rural_populations');
    }
}
