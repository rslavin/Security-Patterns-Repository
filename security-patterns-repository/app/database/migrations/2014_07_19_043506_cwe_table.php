<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CweTable extends Migration {

	public function up()
	{
		Schema::create('cwe', function($table) {
			$table->increments('id');
			$table->string('name', 20);
			$table->integer('cwe_set_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cwe');
	}

}
