<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDimensionsOfPovertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimensions_of_poverties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('indicator')->nullable();
            $table->decimal('household_magnitude', 20,2)->nullable();
            $table->decimal('household_proportion', 20,2)->nullable();

            $table->decimal('population_magnitude_total', 20,2)->nullable();
            $table->decimal('population_magnitude_male', 20,2)->nullable();
            $table->decimal('population_magnitude_female', 20,2)->nullable();
            $table->decimal('population_proportion_total', 20,2)->nullable();
            $table->decimal('population_proportion_male', 20,2)->nullable();
            $table->decimal('population_proportion_female', 20,2)->nullable();
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
        Schema::dropIfExists('dimensions_of_poverties');
    }
}
