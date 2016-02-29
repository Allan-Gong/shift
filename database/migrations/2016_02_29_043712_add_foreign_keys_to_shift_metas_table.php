<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToShiftMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shift_metas', function(Blueprint $table)
		{
			$table->foreign('shift_id')->references('id')->on('shifts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shift_metas', function(Blueprint $table)
		{
			$table->dropForeign('shift_metas_shift_id_foreign');
		});
	}

}
