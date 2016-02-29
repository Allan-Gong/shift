<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShiftMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shift_metas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shift_id')->unsigned()->unique();
			$table->date('repeat_start');
			$table->date('repeat_end')->default('2099-12-30');
			$table->integer('repeat_interval')->unsigned();
			$table->string('repeat_year');
			$table->string('repeat_month');
			$table->string('repeat_week');
			$table->string('repeat_weekday');
			$table->string('repeat_day');
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
		Schema::drop('shift_metas');
	}

}
