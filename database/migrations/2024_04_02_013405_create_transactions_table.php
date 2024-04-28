<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('flight_id');
            $table->foreign('flight_id')->references('id')->on('flights')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('code_no')->unique()->index();

            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('adult')->nullable();
            $table->integer('children')->nullable();
            $table->integer('baby')->nullable();

            $table->unsignedBigInteger('start_location_id');
            $table->foreign('start_location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('end_location_id');
            $table->foreign('end_location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->dateTime('start_day')->nullable();
            $table->dateTime('end_day')->nullable();

            $table->bigInteger('price')->nullable();
            $table->bigInteger('baby_ticket')->nullable();
            $table->bigInteger('expense')->nullable()->comment('phụ phí');
            $table->integer('tax_percentage')->nullable()->comment('phần trăm tính thuế');

            $table->tinyInteger('ticket_class')->default(1);
            $table->tinyInteger('status')->default(1);

            // dữ liệu thống kê
            $table->bigInteger('taxes_fees')->default(0);
            $table->bigInteger('total_money')->default(0);

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
        Schema::dropIfExists('transactions');
    }
}
