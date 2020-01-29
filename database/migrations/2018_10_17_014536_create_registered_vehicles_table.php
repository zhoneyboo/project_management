<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteredVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cars')->default(0);
            $table->integer('suv_uv')->default(0);
            $table->integer('tricycle')->default(0);
            $table->integer('truck')->default(0);
            $table->integer('truck_bus')->default(0);
            $table->integer('motorcycle')->default(0);
            $table->integer('uv_jeep')->default(0);
            $table->integer('month');
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
        Schema::dropIfExists('registered_vehicles');
    }
}
