<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid');
            $table->string('fullname');
            $table->string('ininame');
            $table->string('regno');
            $table->string('nic');
            $table->date('dob');
            $table->string('gender');
            $table->string('paddress');
            $table->string('raddress')->nullable();
            $table->string('hphone');
            $table->string('mphone');
            $table->string('wphone')->nullable();
            $table->string('email')->nullable();
            $table->string('catogary')->default("Trainee");
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
        Schema::dropIfExists('people');
    }
}
