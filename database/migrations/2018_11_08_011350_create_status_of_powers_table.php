<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusOfPowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_of_powers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->integer('barangay_covered');
            $table->integer('barangay_energized');
            $table->integer('sitios_energized');
            $table->integer('sitios_unerginized');
            $table->integer('house_connections');
            $table->integer('members_approved');
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
        Schema::dropIfExists('status_of_powers');
    }
}
