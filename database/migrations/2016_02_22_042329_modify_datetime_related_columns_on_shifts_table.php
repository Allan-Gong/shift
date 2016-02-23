<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDatetimeRelatedColumnsOnShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->string('start_time')->nullable()->change();
            $table->string('finish_time')->nullable()->change();
            $table->string('clock_on')->nullable()->change();
            $table->string('clock_off')->nullable()->change();
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
