<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVegetableProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vegetable_productions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commodity');
            $table->decimal('area_harvested', 20, 2)->default(0);
            $table->decimal('production_mt', 20, 2)->default(0);
            $table->decimal('arerage_yield', 20, 1)->default(0);
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
        Schema::dropIfExists('vegetable_productions');
    }
}
