<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaincoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raincoats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color');
            $table->string('company');
            $table->string('size');
            $table->integer('quantity');
            $table->integer('reorder_level');
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
        Schema::dropIfExists('raincoats');
    }
}
