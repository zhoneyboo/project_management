<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelByStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnel_by_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permanent_first_male');
            $table->integer('permanent_first_female');
            $table->integer('permanent_second_male');
            $table->integer('permanent_second_female');
            $table->integer('co_terminous_first_male');
            $table->integer('co_terminous_first_female');
            $table->integer('co_terminous_second_male');
            $table->integer('co_terminous_second_female');
            $table->integer('elective_male');
            $table->integer('elective_female');
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
        Schema::dropIfExists('personnel_by_statuses');
    }
}
