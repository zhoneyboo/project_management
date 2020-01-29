<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoastalResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coastal_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipality');
            $table->decimal('municipal_water', 10, 2)->default(0);
            $table->decimal('mpa', 10, 2)->default(0);
            $table->decimal('mpa_percent', 10, 2)->default(0);
            $table->decimal('year', 10, 2)->default(0);
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
        Schema::dropIfExists('coastal_resources');
    }
}
