<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployeesTableV3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('academic_level')->nullable()->comment('trình độ học vấn');
            $table->string('home_town')->nullable()->comment('quê quán');
            $table->string('cmnd')->nullable()->comment('số cmnd');
            $table->date('time_start')->nullable()->comment('thời gian bắt đầu làm việc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['academic_level', 'home_town', 'cmnd', 'time_start']);
        });
    }
}
