<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelByOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnel_by_offices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_of_office');
            $table->string('no_plantilla_position');
            $table->string('no_of_filled_up_position');
            $table->integer('group');
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
        Schema::dropIfExists('personnel_by_offices');
    }
}
