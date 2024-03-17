<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcadamiccalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acadamiccalenders', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('batch');
            $table->string('lessoncontent');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->double('slotsize');
            $table->integer('uid');
            $table->string('status')->default("not conducted");
            $table->string('color')->nulluble();
            $table->boolean('allday')->default(1);
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
        Schema::dropIfExists('acadamiccalenders');
    }
}
