<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShiftTypeForeignConstraintToShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->integer('shift_type_id')->unsigned()->nullable();
            $table->index('shift_type_id');
        });

        Schema::table('shifts', function (Blueprint $table) {
            $table->foreign('shift_type_id')->references('id')->on('shift_types');
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
            $table->dropIndex('shift_type_id');
            $table->dropForeign('shifts_shift_type_id_foreign');
            $table->dropColumn('shift_type_id');
        });
    }
}
