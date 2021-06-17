<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->string('image');
            $table->string('rate')->nullable();
            $table->string('phone')->nullable();
            $table->string('price')->nullable();
            $table->string('hours')->nullable();
            $table->string('facilities')->nullable();
            $table->string('types')->nullable();

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
        Schema::dropIfExists('locations');
    }
}
