<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('subject');

            $table->tinyInteger('status')->default(0)->comment('0:toDo,1:doing,2:done,3:block');

            $table->tinyInteger('priority')->comment('highest is:5,lowest:1');

            $table->dateTime('deadline');

            $table->tinyInteger('privilege')->comment('0:personal,1:admin,2:department,3:public');

            $table->dateTime('seen')->nullable();

            $table->time('worklog');

            $table->bigInteger('ticket_id')->unsigned();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('tasks');
    }
}
