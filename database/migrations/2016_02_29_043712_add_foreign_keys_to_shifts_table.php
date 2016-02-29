<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToShiftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shifts', function(Blueprint $table)
		{
			$table->foreign('role_id', 'shifts_role_foreign')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('shift_type_id')->references('id')->on('shift_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'shifts_user_foreign')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('venue_id', 'shifts_venue_foreign')->references('id')->on('venues')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shifts', function(Blueprint $table)
		{
			$table->dropForeign('shifts_role_foreign');
			$table->dropForeign('shifts_shift_type_id_foreign');
			$table->dropForeign('shifts_user_foreign');
			$table->dropForeign('shifts_venue_foreign');
		});
	}

}
