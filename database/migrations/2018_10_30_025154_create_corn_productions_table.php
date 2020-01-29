<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCornProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corn_productions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->decimal('no_of_farmers', 20, 2)->default(0);
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
        Schema::dropIfExists('corn_productions');
    }
}
