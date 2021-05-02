<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 12)->nullable();
            $table->date('dob')->nullable();
            $table->text('image')->nullable();
            $table->string('address')->nullable();
            $table->integer('position_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('status')->default(1)->comment('1 : active');

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
        Schema::dropIfExists('employees');
    }
}
