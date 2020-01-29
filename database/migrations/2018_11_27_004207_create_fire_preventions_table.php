<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirePreventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fire_preventions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('municipality');
            $table->integer('no_of_fire_station_bfp')->default(0);
            $table->integer('no_of_fire_station_lgu')->default(0);
            $table->integer('no_of_fire_trucks_bfp')->default(0);
            $table->integer('no_of_fire_trucks_lgu')->default(0);
            $table->integer('no_of_fire_trucks_ngo')->default(0);
            $table->integer('no_of_personnel')->default(0);
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
        Schema::dropIfExists('fire_preventions');
    }
}
