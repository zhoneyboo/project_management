<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectedPopulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projected_populations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projected_population_infos_id');
            $table->string('province');
            $table->integer('actual_year_1')->default(0);
            $table->integer('actual_year_2')->default(0);
            $table->decimal('growth_rate', 2, 2)->default(0);
            $table->integer('projection_year_1')->default(0);
            $table->integer('projection_year_2')->default(0);
            $table->integer('projection_year_3')->default(0);
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
        Schema::dropIfExists('projected_populations');
    }
}
