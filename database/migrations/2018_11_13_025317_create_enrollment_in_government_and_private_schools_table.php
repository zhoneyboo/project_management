<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentInGovernmentAndPrivateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_in_government_and_private_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('educational_level');
            $table->integer('province_public')->default(0);
            $table->integer('province_private')->default(0);
            $table->integer('calapan_public')->default(0);
            $table->integer('calapan_private')->default(0);
            $table->integer('calapan_luc_suc')->default(0);
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
        Schema::dropIfExists('enrollment_in_government_and_private_schools');
    }
}
