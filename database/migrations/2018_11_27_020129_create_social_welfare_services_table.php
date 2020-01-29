<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialWelfareServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_welfare_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('municipality');
            $table->integer('social_worker_male')->default(0);
            $table->integer('social_worker_female')->default(0);
            $table->integer('day_care_male')->default(0);
            $table->integer('day_care_female')->default(0);
            $table->integer('no_of_day_care_centers')->default(0);
            $table->integer('children_served_male')->default(0);
            $table->integer('children_served_female')->default(0);
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
        Schema::dropIfExists('social_welfare_services');
    }
}
