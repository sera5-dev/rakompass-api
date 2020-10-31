<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Social;

class SocialSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      'whatsapp',
      'facebook',
      'instragram',
      'youtube',
      'twitter',
      'telegram',
    ];

    foreach ($data as $d) {
      $social = new Social;
      $social->name = $d;
      $social->save();
    }
  }
}
