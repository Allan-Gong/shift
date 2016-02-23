<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNullableColumnsOnShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->nullable()->change();
            $table->integer('user_id')->unsigned()->nullable()->change();
            $table->integer('venue_id')->unsigned()->nullable()->change();

            $table->dateTime('start_time')->nullable()->change();
            $table->dateTime('finish_time')->nullable()->change();
            $table->dateTime('clock_on')->nullable()->change();
            $table->dateTime('clock_off')->nullable()->change();
            $table->string('notes')->nullable()->change();
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
            //
        });
    }
}
