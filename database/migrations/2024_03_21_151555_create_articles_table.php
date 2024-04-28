<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->index();
            $table->tinyInteger('show_home')->default(0)->index();
            $table->integer('view')->default(0);
            $table->mediumText('description')->nullable();
            $table->string('image')->nullable();
            $table->text('contents')->nullable();
            $table->unsignedBigInteger('category_id')->index()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('articles');
    }
}
