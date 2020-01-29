<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeAndExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_and_expenditures', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('income_general_fund',20,2)->default(0);
            $table->decimal('expenditures_obligations',20,2)->default(0);

            $table->decimal('tax_revenue',20,2)->default(0);
            $table->decimal('permit_and_license',20,2)->default(0);
            $table->decimal('service_income',20,2)->default(0);
            $table->decimal('business_income',20,2)->default(0);
            $table->decimal('other_income',20,2)->default(0);
            $table->decimal('grants_and_donation',20,2)->default(0);
            $table->decimal('personal_services',20,2)->default(0);
            $table->decimal('mooe',20,2)->default(0);
            $table->decimal('capitals_outlays',20,2)->default(0);
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
        Schema::dropIfExists('income_and_expenditures');
    }
}
