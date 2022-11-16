<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('HotelName');
            $table->string('City');
            $table->string('Country');
            $table->string('Continent');
            $table->string('Activity');
            $table->smallInteger('StarRating');
            $table->string('TempRating');
            $table->string('Location');
            $table->smallInteger('PricePerNight');
            $table->smallInteger('Weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holidays');
    }
}
