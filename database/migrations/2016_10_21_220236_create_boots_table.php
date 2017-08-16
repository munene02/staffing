<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id');
            $table->integer('boot_height_id')->unsigned()->index();
            $table->integer('shoe_size_id')->unsigned()->index();
            $table->string('quantity');
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
        Schema::dropIfExists('boots');
    }
}
