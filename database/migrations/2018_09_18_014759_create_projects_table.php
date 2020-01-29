<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('control_number');
            $table->boolean('mode_of_implementation');
            $table->string('contractor')->nullable();
            $table->integer('loc_barangay')->nullable();
            $table->integer('loc_municipality')->nullable();


            $table->integer('implementing_agency');
            $table->string('other_implementing_agency')->nullable();
            $table->integer('municipality')->nullable();

            $table->integer('fund_source');
            $table->year('fund_source_year');
            $table->string('specific_fund_source')->nullable();


            $table->integer('sector');

            $table->decimal('project_cost', 20, 4);
            $table->boolean('status')->default(0);


            $table->integer('monitored_by')->default(5);
            $table->date('date_monitored')->nullable();
            $table->boolean('monitoring_status')->default(0);

            $table->string('link')->nullable();





            
            $table->softDeletes();
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
        Schema::dropIfExists('projects');
    }
}
