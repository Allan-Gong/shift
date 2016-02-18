<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsToShiftApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shift_applicants', function (Blueprint $table) {
            $table->renameColumn('shift', 'shift_id');
            $table->renameColumn('applicant', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shift_applicants', function (Blueprint $table) {
            $table->renameColumn('shift_id', 'shift');
            $table->renameColumn('user_id', 'applicant');
        });
    }
}
