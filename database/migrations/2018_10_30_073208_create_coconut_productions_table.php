<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoconutProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coconut_productions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->integer('no_of_coconut_farmers')->default(0);
            $table->integer('coconut_area')->default(0);
            $table->integer('no_of_coco_trees')->default(0);
            $table->integer('non_bearing')->default(0);
            $table->integer('bearing')->default(0);
            $table->integer('nut_tree_year')->default(0);
            $table->integer('wholenuts')->default(0);
            $table->integer('copra_equivalent')->default(0);
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
        Schema::dropIfExists('coconut_productions');
    }
}
