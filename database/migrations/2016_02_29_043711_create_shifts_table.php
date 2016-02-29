<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShiftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shifts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->unsigned()->nullable()->index();
			$table->integer('user_id')->unsigned()->nullable()->index();
			$table->integer('venue_id')->unsigned()->nullable()->index();
			$table->string('start_time')->nullable();
			$table->string('finish_time')->nullable();
			$table->string('clock_on')->nullable();
			$table->string('clock_off')->nullable();
			$table->string('notes')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->date('date')->nullable()->index();
			$table->integer('shift_type_id')->unsigned()->nullable()->index();
			$table->integer('shift_status_id')->unsigned()->nullable()->index();
			$table->string('status');
			$table->timestamp('repeating')->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shifts');
	}

}
