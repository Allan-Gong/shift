<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToShiftApplicantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shift_applicants', function(Blueprint $table)
		{
			$table->foreign('user_id', 'shift_applicants_applicant_foreign')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('shift_id', 'shift_applicants_shift_foreign')->references('id')->on('shifts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shift_applicants', function(Blueprint $table)
		{
			$table->dropForeign('shift_applicants_applicant_foreign');
			$table->dropForeign('shift_applicants_shift_foreign');
		});
	}

}
