<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeographicalZoneSurfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geographical_zone_surfaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coastal_area');
            $table->string('lake_areas');
            $table->string('total_land_mass');
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
        Schema::dropIfExists('geographical_zone_surfaces');
    }
}
