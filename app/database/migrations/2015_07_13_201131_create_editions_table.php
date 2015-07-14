<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('editions', function($table)
		{
			$table->increments('id');
			$table->string('title', 255);
			$table->string('type', 255)->nullable();
			$table->longtext('content')->nullable();
			$table->string('badge', 255)->nullable();
			$table->string('psd', 255)->nullable();
			$table->string('users', 255)->nullable();
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
		Schema::drop('editions');
	}

}
