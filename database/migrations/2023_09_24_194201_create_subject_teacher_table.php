<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjectteacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacherid'); // Assuming you have a 'teacher' table with an 'id' column
            $table->unsignedBigInteger('courseid');
            $table->unsignedBigInteger('subjectid');
            $table->decimal('rateperhour', 10, 2); // Adjust the precision and scale as needed
            $table->date('startdate');
            $table->date('enddate');
            $table->string('status')->default('Unassinged');

            $table->timestamps();
            $table->foreign('teacherid')->references('id')->on('people');
            $table->foreign('courseid')->references('id')->on('batch');
            $table->foreign('subjectid')->references('id')->on('batchsubjects');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjectteacher');
    }
}
