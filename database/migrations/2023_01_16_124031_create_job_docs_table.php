<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_docs', function (Blueprint $table) {
            $table->bigIncrements('id');  ;
            $table->string('regno');
            $table->bigInteger('docid');
            $table->string('sn');
            $table->date('recived')->nullable();
            $table->date('issued')->nullable();
            $table->date('expired')->nullable();
            $table->string('isrecieved')->default('no');
            
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
        Schema::dropIfExists('job_docs');
    }
}
