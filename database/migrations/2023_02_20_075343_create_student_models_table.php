<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_models', function (Blueprint $table) {
            $table->id();
            $table->string("regNo")->unique();
            $table->unsignedBigInteger("applicantid");
            $table->foreign('applicantid')->references('id')->on('applicants');
            $table->date('registerd')->nullable();
            $table->date('completed')->nullable();
            $table->date('dropout')->nullable();
            $table->string("dropReason")->nullable();
            $table->string("status")->default('Registered');
            $table->unsignedBigInteger("uid");
            $table->timestamps();
            $table->foreign('uid')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_models');
    }
}
