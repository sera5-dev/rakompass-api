<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewSocialTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('crew_social', function (Blueprint $table) {
      $table->id();
      $table->foreignId('crew_id')->references('id')->on('crews')->onDelete('cascade');
      $table->foreignId('social_id')->references('id')->on('socials')->onDelete('cascade');
      $table->string('username')->unique();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('crew_social');
  }
}
