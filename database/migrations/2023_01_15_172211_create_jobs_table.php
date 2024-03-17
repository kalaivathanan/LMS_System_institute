<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('regno');
            $table->string('jobtype');
            $table->dateTime('regdate');
            $table->decimal('amount', 9, 2);
            $table->dateTime('examdate')->nullable();
            $table->string('examstatus')->default("Pending");
            $table->string('lpermitno')->nullable();
            $table->dateTime('lpermitdate')->nullable();
            $table->dateTime('lpermitexp')->nullable();
            $table->dateTime('trialdate')->nullable();
            $table->string('jobstatus')->default("Pending");;
            $table->timestamps();
            $table->integer('uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
