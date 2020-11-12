<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Social as Obj;

class SocialSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $datas = [
      ['name' => 'whatsapp'],
      ['name' => 'facebook'],
      ['name' => 'instragram'],
      ['name' => 'youtube'],
      ['name' => 'twitter'],
      ['name' => 'telegram'],
    ];

    foreach ($datas as $data)
      Obj::create($data);
  }
}
