<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopulationDensitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('population_densities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('population_density_infos_id');
            $table->integer('municipality');

            $table->integer('gross_old')->default(0);
            $table->integer('gross_actual')->default(0);

            $table->integer('urban_old')->default(0);
            $table->integer('urban_actual')->default(0);
            $table->integer('estimated_gross')->default(0);
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
        Schema::dropIfExists('population_densities');
    }
}
