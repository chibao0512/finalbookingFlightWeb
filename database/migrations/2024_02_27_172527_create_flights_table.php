<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //flights chuyến bay
        Schema::create('flights', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('plane_id');
            $table->foreign('plane_id')->references('id')->on('planes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('start_location_id');
            $table->foreign('start_location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('start_airport_id');
            $table->foreign('start_airport_id')->references('id')->on('airports')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('end_location_id');
            $table->foreign('end_location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('end_airport_id');
            $table->foreign('end_airport_id')->references('id')->on('airports')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('code_no', 50)->nullable();
            $table->date('start_day')->nullable();
            $table->string('start_time')->nullable();
            $table->date('end_day')->nullable();
            $table->string('end_time')->nullable();
            $table->bigInteger('price')->default(0);
            $table->bigInteger('price_vip')->default(0);
            $table->integer('taxes_fees')->default(0);
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
        Schema::dropIfExists('flights');
    }
}
