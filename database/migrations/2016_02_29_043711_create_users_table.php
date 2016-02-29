<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('gender');
			$table->date('date_of_birth');
			$table->string('workplace');
			$table->string('email')->unique()->index();
			$table->string('password', 60);
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->boolean('is_admin')->default(0);
			// $table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
