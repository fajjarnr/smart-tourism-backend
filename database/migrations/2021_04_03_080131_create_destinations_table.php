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
            $table->unsignedBigInteger('category_id');
            $table->string('latitude');
            $table->string('longitude');
            $table->text('description');
            $table->string('name');
            $table->string('address');
            $table->string('rate')->nullable();
            $table->string('image')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('price')->nullable();
            $table->string('hours')->nullable();
            $table->string('facilities')->nullable();

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
