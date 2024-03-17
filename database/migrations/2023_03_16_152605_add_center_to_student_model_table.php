<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCenterToStudentModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_models', function (Blueprint $table) {
            $table->unsignedBigInteger('center')->nullable();
            $table->foreign('center')->references('id')->on('centers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_models', function (Blueprint $table) {
            $table->dropForeign(['center']);
            $table->dropColumn('center');
        });
    }
}
