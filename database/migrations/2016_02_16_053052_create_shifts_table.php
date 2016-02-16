<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('role')->unsigned();
            $table->integer('assignee')->unsigned();
            $table->integer('venue')->unsigned();

            $table->foreign('role')->references('id')->on('roles');
            $table->foreign('assignee')->references('id')->on('users');
            $table->foreign('venue')->references('id')->on('venues');

            $table->dateTime('start_time');
            $table->dateTime('finish_time');
            $table->dateTime('clock_on');
            $table->dateTime('clock_off');
            $table->string('status');
            $table->string('notes');
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
        Schema::drop('shifts');
    }
}
