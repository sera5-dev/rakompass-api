<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewContactTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('crew_contact', function (Blueprint $table) {
      $table->id();
      $table->foreignId('crew_id')->references('id')->on('crews')->onDelete('cascade');
      $table->foreignId('contact_id')->references('id')->on('contacts')->onDelete('cascade');
      $table->string('value')->unique();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('crew_contact');
  }
}
