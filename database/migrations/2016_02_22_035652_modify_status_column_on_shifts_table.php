<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyStatusColumnOnShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->integer('shift_status_id')->unsigned()->nullable();
            $table->index('shift_status_id');
            // $table->foreign('shift_status_id')->references('id')->on('shift_status');
        });

        Schema::table('shifts', function (Blueprint $table) {
            $table->foreign('shift_status_id')->references('id')->on('shift_status');
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
            $table->dropForeign('shifts_shift_status_id_foreign');
            $table->dropIndex('shift_status_id');
            $table->dropColumn('shift_status_id');
            $table->string('status');
        });
    }
}
