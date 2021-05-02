<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();

            $table->integer('salary')->nullable()->comment('Lương cơ bản');

            $table->integer('days')->nullable()->comment('Số ngày công trong tháng');
            $table->integer('workdays')->nullable()->comment('Số ngày công đã làm');

            $table->integer('sub_salary')->nullable()->comment('Lương tính theo ngày đi làm');

            $table->integer('allowance')->nullable()->comment('Phụ cấp');

            $table->integer('ot_salary')->nullable()->comment('Lương làm thêm');
            $table->integer('ot_hours')->nullable()->comment('Giơ làm thêm');
            $table->integer('ot_ratio')->nullable()->comment('Tỷ lệ lương x mấy/ h');

            $table->integer('owed_salary')->nullable()->comment('Lương còn nợ');

            $table->integer('other_fees')->nullable()->comment('Các phí khác');

            $table->integer('bhxh')->nullable()->comment('Bảo hiểm xã hội');
            $table->integer('bhyt')->nullable()->comment('Bảo hiểm y tế');
            $table->integer('bhtn')->nullable()->comment('Bảo hiểm thất nghiệp');
            $table->integer('tax')->nullable()->comment('Thuế thu nhập cả nhân');

            $table->integer('total_salary')->nullable()->comment('Tổng lương');

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
        Schema::dropIfExists('payrolls');
    }
}
