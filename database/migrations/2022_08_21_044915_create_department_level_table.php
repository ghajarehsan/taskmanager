<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_level', function (Blueprint $table) {

            $table->bigInteger('department_id')->unsigned();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->bigInteger('level_id')->unsigned();

            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');

            $table->primary(['department_id','level_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_level');
    }
}
