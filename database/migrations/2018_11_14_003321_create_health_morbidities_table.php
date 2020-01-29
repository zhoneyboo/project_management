<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthMorbiditiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_morbidities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cause');
            $table->integer('year_no')->default(0);
            $table->integer('year_rate')->default(0);
            $table->integer('five_year_no')->default(0);
            $table->integer('five_year_rate')->default(0);
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
        Schema::dropIfExists('health_morbidities');
    }
}
