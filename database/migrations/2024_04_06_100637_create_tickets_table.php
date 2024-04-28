<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('transport_id')->nullable();
            $table->foreign('transport_id')->references('id')->on('transports')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('flight_id');
            $table->foreign('flight_id')->references('id')->on('flights')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('code_no')->unique()->index();
            $table->tinyInteger('gender')->nullable();
            $table->string('name')->nullable();
            $table->string('card')->nullable();
            $table->string('seats', 100)->nullable();
            $table->date('birthday')->nullable();
            $table->bigInteger('transport_price')->nullable();
            $table->integer('transport_weight')->nullable();

            $table->tinyInteger('status')->default(1);

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
        Schema::dropIfExists('tickets');
    }
}
