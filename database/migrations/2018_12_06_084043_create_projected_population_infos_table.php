<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectedPopulationInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projected_population_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->year('actual_year_1');
            $table->year('actual_year_2');
            $table->string('growth_rate');
            $table->year('projection_year_1');
            $table->year('projection_year_2');
            $table->year('projection_year_3');
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
        Schema::dropIfExists('projected_population_infos');
    }
}
