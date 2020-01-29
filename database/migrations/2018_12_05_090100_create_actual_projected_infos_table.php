<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActualProjectedInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actual_projected_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->year('old_year');
            $table->year('actual_year');
            $table->year('projected_year');
            $table->string('growth_rate_1');
            $table->string('growth_rate_2');
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
        Schema::dropIfExists('actual_projected_infos');
    }
}
