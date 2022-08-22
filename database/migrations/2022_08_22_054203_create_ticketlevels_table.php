<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketlevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketlevels', function (Blueprint $table) {
            $table->id();

            $table->integer('level');

            $table->bigInteger('ticket_id')->unsigned();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');

            $table->bigInteger('department_id')->unsigned();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

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
        Schema::dropIfExists('ticketlevels');
    }
}
