<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketusers', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('level')->unsigned();

            $table->bigInteger('ticket_id')->unsigned();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned()->comment('destination');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('department_id')->unsigned()->comment('destination');

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->bigInteger('status_id')->unsigned();

            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

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
        Schema::dropIfExists('ticketusers');
    }
}
