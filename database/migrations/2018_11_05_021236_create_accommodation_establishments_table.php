<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_establishments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->integer('no_of_accommodation_establishment')->default(0);
            $table->integer('no_of_room')->default(0);
            $table->integer('bedding_capacity')->default(0);
            $table->integer('total_employment')->default(0);
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
        Schema::dropIfExists('accommodation_establishments');
    }
}
