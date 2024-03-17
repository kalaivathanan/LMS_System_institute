<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('ininame');
            $table->string('nic');
            $table->date('dob');
            $table->string('gender');
            $table->string('paddress');
            $table->string('raddress')->nullable();
            $table->string('hphone');
            $table->string('mphone');
            $table->string('wphone');
            $table->string('email');
          
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
        Schema::dropIfExists('applicants');
    }
}
