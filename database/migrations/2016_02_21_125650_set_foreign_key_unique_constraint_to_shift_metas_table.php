<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetForeignKeyUniqueConstraintToShiftMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shift_metas', function (Blueprint $table) {
            $table->unique('shift_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shift_metas', function (Blueprint $table) {
            $table->dropUnique('shift_types_shift_id_unique');
        });
    }
}
