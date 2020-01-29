<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceIndicatorInPublicSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_indicator_in_public_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('indicator');
            $table->decimal('province_elementary');
            $table->decimal('province_secondary');
            $table->decimal('calapan_elementary');
            $table->decimal('calapan_secondary');
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
        Schema::dropIfExists('performance_indicator_in_public_schools');
    }
}
