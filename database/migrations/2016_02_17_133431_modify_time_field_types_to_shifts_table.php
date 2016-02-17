<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTimeFieldTypesToShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->string('start_time', 50)->change();
            $table->string('finish_time', 50)->change();
            $table->string('clock_on', 50)->change();
            $table->string('clock_off', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->dateTime('start_time')->change();
            $table->dateTime('finish_time')->change();
            $table->dateTime('clock_on')->change();
            $table->dateTime('clock_off')->change();
        });
    }
}
