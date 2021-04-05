<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->string('rate')->nullable();
            $table->string('image')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('price')->nullable();
            $table->string('hours')->nullable();
            $table->string('facilities')->nullable();

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories');

            $table->softDeletes();
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
        Schema::dropIfExists('destinations');
    }
}
