<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiceAreaCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rice_area_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->decimal('irrigated_area', 20, 2)->default(0);
            $table->decimal('rainfed_area', 20, 2)->default(0);
            $table->decimal('total_rice_area', 20, 2)->default(0);
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
        Schema::dropIfExists('rice_area_cities');
    }
}
