<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlineCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // airline_companies hãng máy bay
        Schema::create('airline_companies', function (Blueprint $table) {
            $table->id();
            $table->string('code_no', 50)->nullable();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
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
        Schema::dropIfExists('airline_companys');
    }
}
