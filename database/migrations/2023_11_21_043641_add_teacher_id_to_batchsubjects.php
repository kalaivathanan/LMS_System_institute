<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherIdToBatchsubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('batchsubjects', function (Blueprint $table) {
            $table->unsignedBigInteger('teacherid')->nullable();
            $table->foreign('teacherid')->references('id')->on('people'); //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('batchsubjects', function (Blueprint $table) {
            $table->dropForeign(['teacherid']);
            $table->dropColumn('teacherid');
        });
    }
}
