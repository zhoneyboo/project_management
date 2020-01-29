<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeniorCitizenAndPersonWithDisabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senior_citizen_and_person_with_disabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->integer('senior_male');
            $table->integer('senior_female');
            $table->integer('disability_male');
            $table->integer('disability_female');
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
        Schema::dropIfExists('senior_citizen_and_person_with_disabilities');
    }
}
