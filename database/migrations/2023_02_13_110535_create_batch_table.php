<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch', function (Blueprint $table) {
            $table->id();
            $table->string('coursecode');
            $table->unsignedBigInteger('realcourseid');
            $table->double('fee');
            $table->string('startdate')->nullable();
            $table->string('installment')->default("1");
            $table->string('daysperweek')->default("5");
            $table->string('duration');
            $table->string('public');
            $table->double('basepayment');
            $table->double('regFee')->default(0);
            $table->string('batchstatus')->default("on goin");
            $table->string('enddate')->nullable();
            $table->string('lockdate')->nullable();
            $table->string('createdby');
            $table->timestamps();
            $table->foreign('coursecode')->references('code')->on('coursemodels');
            $table->foreign('realcourseid')->references('id')->on('coursemodels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch');
    }
}
