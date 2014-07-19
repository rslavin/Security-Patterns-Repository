<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CweSetTable extends Migration {

	public function up()
	{
		Schema::create('cwe_set', function($table) {
			$table->increments('id');
			$table->integer('pattern_id');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('cwe_set');
	}

}
