<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisataReligisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisata_religis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('images');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('phoneNumber');
            $table->string('htm');
            $table->string('address');
            $table->string('hours');
            $table->string('rides');
            $table->string('facilities');
            $table->string('route');
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
        Schema::dropIfExists('wisata_religis');
    }
}
