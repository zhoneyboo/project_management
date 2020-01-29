<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstablishedMarineProtectedAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('established_marine_protected_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->string('name_of_mpa');
            $table->string('location');
            $table->year('year_stablished');
            $table->decimal('estimated_area', 10, 2)->default(0);
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
        Schema::dropIfExists('established_marine_protected_areas');
    }
}
