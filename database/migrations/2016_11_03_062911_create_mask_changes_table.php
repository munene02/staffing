<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaskChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mask_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mask_id')->unsigned()->index();
            $table->string('variant');
            $table->integer('before_quantity');
            $table->integer('quantity_increment');
            $table->integer('after_quantity');
            $table->integer('user_id')->unsigned()->index();
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
        Schema::dropIfExists('mask_changes');
    }
}
