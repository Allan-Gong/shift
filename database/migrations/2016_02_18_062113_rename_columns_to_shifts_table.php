<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsToShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->renameColumn('role', 'role_id');
            $table->renameColumn('assignee', 'user_id');
            $table->renameColumn('venue', 'venue_id');
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
            $table->renameColumn('role_id', 'role');
            $table->renameColumn('user_id', 'assignee');
            $table->renameColumn('venue_id', 'venue');
        });
    }
}
