<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrimeStatisticsAndProtectiveFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crime_statistics_and_protective_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_crime');
            $table->string('crime');
            $table->decimal('number', 20, 2);
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
        Schema::dropIfExists('crime_statistics_and_protective_facilities');
    }
}
