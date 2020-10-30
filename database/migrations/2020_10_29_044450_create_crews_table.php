<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crews', function (Blueprint $table) {
			$table->id();
			$table->string('nama');
			$table->string('alamat')->nullable();
			$table->string('tempat_lahir')->nullable();
			$table->string('tanggal_lahir')->nullable();
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
		Schema::dropIfExists('crews');
	}
}
