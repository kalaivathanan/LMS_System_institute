<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemprfidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temprfid', function (Blueprint $table) {
            $table->bigIncrements('id'); // Assuming there is an applicant_id column to associate with applicants
            $table->unsignedBigInteger('applicantid');
            $table->string('rfid')->nullable();
            $table->string('name');
            $table->string('status')->default("ini");
            $table->date('regtime')->nullable();
            $table->date('accepttime')->nullable();
            $table->date('deltime')->nullable();
            $table->unsignedBigInteger("uid");
            $table->foreign('uid')->references('id')->on('users');
            $table->foreign('applicantid')->references('id')->on('applicants');
            $table->unsignedBigInteger("createdby");
            $table->foreign('createdby')->references('id')->on('users');
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
        Schema::dropIfExists('temprfid');
    }
}
