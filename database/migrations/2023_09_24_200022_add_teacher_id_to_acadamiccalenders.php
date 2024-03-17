<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherIdToAcadamiccalenders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acadamiccalenders', function (Blueprint $table) {
            $table->unsignedBigInteger('teacherid')->nullable();
            $table->foreign('teacherid')->references('teacherid')->on('subjectteacher');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acadamiccalenders', function (Blueprint $table) {
            $table->dropForeign(['teacherid']);
            $table->dropColumn('teacherid');
        });
    }
}
