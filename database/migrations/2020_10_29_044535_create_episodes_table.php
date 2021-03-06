<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('episodes', function (Blueprint $table) {
      $table->id();
      $table->foreignId('schedule_id')->references('id')->on('schedules');
      $table->string('link');
      $table->integer('episode')->nullable();
      $table->string('theme')->nullable();
      $table->string('date')->nullable();
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
    Schema::dropIfExists('episodes');
  }
}
