<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('abouts', function (Blueprint $table) {
			$table->id();
			$table->string('nama');
			$table->string('alamat');
			$table->string('kontak')->nullable();
			$table->string('email')->nullable();
			$table->string('whatsapp')->nullable();
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('twitter')->nullable();
			$table->string('youtube')->nullable();
			$table->longText('sejarah')->nullable();
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
		Schema::dropIfExists('abouts');
	}
}
