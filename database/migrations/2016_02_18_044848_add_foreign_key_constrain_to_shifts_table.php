<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyConstrainToShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->dropForeign('shifts_role_foreign');
            $table->dropForeign('shifts_assignee_foreign');
            $table->dropForeign('shifts_venue_foreign');

            $table->foreign('role')->references('id')->on('roles')->onDelete('set null');
            $table->foreign('assignee')->references('id')->on('users')->onDelete('set null');
            $table->foreign('venue')->references('id')->on('venues')->onDelete('set null');
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
