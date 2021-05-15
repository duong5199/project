<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurrancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurrances', function (Blueprint $table) {
            $table->id();

            $table->integer('employee_id');
            $table->string('code');
            $table->string('bhxh')->nullable();
            $table->string('bhyt')->nullable();
            $table->string('address_active')->comment('Nơi cấp');
            $table->date('date_active')->comment('Ngày cấp');
            $table->date('date_expired')->comment('Ngày hết hạn');
            $table->integer('status');

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
        Schema::dropIfExists('departments');
    }
}
