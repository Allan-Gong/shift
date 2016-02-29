<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShiftApplicantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shift_applicants', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shift_id')->unsigned()->index('shift_applicants_shift_foreign');
			$table->integer('user_id')->unsigned()->index('shift_applicants_applicant_foreign');
			$table->string('notes');
			$table->string('status');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shift_applicants');
	}

}
