<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->integer('transaction_id')->nullable();
            $table->float('money')->nullable()->comment('Số tiền thanh toán');
            $table->string('notes')->nullable()->comment('Nội dung thanh toán');
            $table->string('vnp_response_code', 255)->nullable()->comment('Mã phản hồi');
            $table->string('code_vnpay', 255)->nullable()->comment('Mã giao dịch vnpay');
            $table->string('code_bank', 255)->nullable()->comment('Mã ngân hàng');
            $table->dateTime('time')->nullable()->comment('Thời gian chuyển khoản');

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
        Schema::dropIfExists('payments');
    }
}
