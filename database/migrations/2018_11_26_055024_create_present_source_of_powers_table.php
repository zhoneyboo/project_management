<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresentSourceOfPowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('present_source_of_powers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('power_plant');
            $table->integer('installed_capacity')->default(0);
            $table->decimal('dependable_capacity', 20, 2)->default(0);
            $table->integer('municipality');
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
        Schema::dropIfExists('present_source_of_powers');
    }
}
