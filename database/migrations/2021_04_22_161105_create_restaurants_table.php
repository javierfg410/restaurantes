<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id('id_restaurant');
            $table->string('name' , 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('town', 191)->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_user')->references('id')->on('users');
        });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
