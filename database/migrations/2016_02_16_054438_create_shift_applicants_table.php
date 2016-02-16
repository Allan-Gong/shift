<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_applicants', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('shift')->unsigned();
            $table->integer('applicant')->unsigned();

            $table->foreign('shift')->references('id')->on('shifts');
            $table->foreign('applicant')->references('id')->on('users');

            $table->string('notes');
            $table->string('status');

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
        Schema::drop('shift_applicants');
    }
}
