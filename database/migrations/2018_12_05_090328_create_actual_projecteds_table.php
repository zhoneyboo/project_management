<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActualProjectedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actual_projecteds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actual_projected_infos_id')->default(0);
            $table->integer('municipality')->default(0);
            $table->integer('old_year_pop')->default(0);
            $table->integer('old_year_hh')->default(0);
            $table->integer('actual_year_pop')->default(0);
            $table->integer('actual_year_hh')->default(0);
            $table->integer('projected_year_pop')->default(0);
            $table->integer('projected_year_hh')->default(0);
            $table->integer('growth_rate_1')->default(0);
            $table->integer('growth_rate_2')->default(0);
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
        Schema::dropIfExists('actual_projecteds');
    }
}
