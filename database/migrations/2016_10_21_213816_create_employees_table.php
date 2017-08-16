<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastName');
            $table->string('otherName');
            $table->string('employeeId');
            $table->string('nationalId');
            $table->string('mobile');
            $table->string('nssf');
            $table->string('nhif');
            $table->string('pin');
            $table->integer('site_id');
            $table->integer('bank_id');
            $table->integer('branch_id');
            $table->integer('category_id');
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
        Schema::dropIfExists('employees');
    }
}
