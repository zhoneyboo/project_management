<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensePermitIssuedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_permit_issueds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("pro_new_first_sem")->default(0);
            $table->integer("pro_new_second_sem")->default(0);
            $table->integer("pro_renew_first_sem")->default(0);
            $table->integer("pro_renew_second_sem")->default(0);

            $table->integer("non_pro_new_first_sem")->default(0);
            $table->integer("non_pro_new_second_sem")->default(0);
            $table->integer("non_pro_renew_first_sem")->default(0);
            $table->integer("non_pro_renew_second_sem")->default(0);

            $table->integer("student_first_sem")->default(0);
            $table->integer("student_second_sem")->default(0);
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
        Schema::dropIfExists('license_permit_issueds');
    }
}
