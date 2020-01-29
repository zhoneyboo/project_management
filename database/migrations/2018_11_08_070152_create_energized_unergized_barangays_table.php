<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergizedUnergizedBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energized_unergized_barangays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->integer('potential')->default(0);
            $table->integer('energized')->default(0);
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
        Schema::dropIfExists('energized_unergized_barangays');
    }
}
