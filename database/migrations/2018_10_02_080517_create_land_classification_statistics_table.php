<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandClassificationStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_classification_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('certified_alienable_and_disposable_land', 20, 2);
            $table->decimal('forest_land_unclassified', 20, 2);
            $table->decimal('forest_land_classified', 20, 2);
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
        Schema::dropIfExists('land_classification_statistics');
    }
}
