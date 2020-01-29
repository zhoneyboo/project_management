<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location')->nullable();
            $table->string('topography')->nullable();
            $table->string('land_area')->nullable();
            $table->string('boundary')->nullable();
            $table->string('climate')->nullable();
            $table->string('capital')->nullable();
            $table->date('date_of_approval')->nullable();
            $table->string('legal_basis')->nullable();
            $table->integer('no_of_component_city')->default(0);
            $table->integer('no_of_municipality')->default(0);
            $table->integer('no_of_congressional_district')->default(0);
            $table->integer('no_of_barangay')->default(0);
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
        Schema::dropIfExists('general_informations');
    }
}
