<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPaymentsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_payments_models', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->double('amount');
            $table->string('order');
            $table->string('paidDate')->nullable();
            $table->string('duedate')->nullable();
            $table->string('status');
            $table->string('invoice')->unique()->nullable();
            $table->unsignedBigInteger("applicantid");
            $table->foreign('applicantid')->references('id')->on('applicants');
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
        Schema::dropIfExists('student_payments_models');
    }
}
