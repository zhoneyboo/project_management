<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHighValueCommercialCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('high_value_commercial_crops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commodity');
            $table->integer('farmers_served')->default(0);
            $table->integer('no_of_trees_planted')->default(0);
            $table->decimal('planted_area', 20, 2)->default(0);
            $table->decimal('production', 20, 2)->default(0);
            $table->decimal('average_yield', 20, 2)->default(0);
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
        Schema::dropIfExists('high_value_commercial_crops');
    }
}
