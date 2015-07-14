<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clubs', function($table)
		{
			$table->increments('id');
			$table->string('slug', 64);
			$table->string('title', 255);
			$table->string('avatar', 255)->nullable();
			$table->longtext('description')->nullable();
			$table->string('premium', 64)->nullable();
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('clubs');
	}
}
