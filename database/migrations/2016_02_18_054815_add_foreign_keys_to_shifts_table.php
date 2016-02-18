<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shiftsle', function (Blueprint $table) {
            $table->foreign('role')->references('id')->on('roles');
            $table->foreign('assignee')->references('id')->on('users');
            $table->foreign('venue')->references('id')->on('venues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shiftsle', function (Blueprint $table) {
            //
        });
    }
}
