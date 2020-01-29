<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIrrigatedAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irrigated_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->decimal('ris', 10, 2)->default(0);
            $table->decimal('cis', 10, 2)->default(0);
            $table->decimal('pump', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
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
        Schema::dropIfExists('irrigated_areas');
    }
}
