<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // planes máy bay
        Schema::create('planes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('airline_company_id');
            $table->foreign('airline_company_id')->references('id')->on('airline_companies')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('code_no', 50)->nullable();
            $table->string('name')->nullable();
            $table->integer('number_seats')->default(0);
            $table->integer('number_seats_vip')->default(0);
            $table->text('content')->nullable();
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
        Schema::dropIfExists('planes');
    }
}
