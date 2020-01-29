<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommerceAndIndustriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_and_industries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sectoral_classification');
            $table->integer('no_of_applications')->default(0);
            $table->decimal('investments', 20, 2)->default(0);
            $table->integer('employment')->default(0);
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
        Schema::dropIfExists('commerce_and_industries');
    }
}
