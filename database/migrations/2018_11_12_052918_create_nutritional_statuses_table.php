<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutritionalStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutritional_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('age_range');
            $table->integer('normal_boys');
            $table->integer('normal_girls');
            $table->integer('underweight_boys');
            $table->integer('underweight_girls');
            $table->integer('severely_boys');
            $table->integer('severely_girls');
            $table->integer('overweight_boys');
            $table->integer('overweight_girls');
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
        Schema::dropIfExists('nutritional_statuses');
    }
}
