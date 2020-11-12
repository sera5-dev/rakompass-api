<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Contact as Obj;

class ContactSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $datas = [
      ['name' => 'ponsel'],
      ['name' => 'telepon'],
      ['name' => 'email'],
      ['name' => 'fax'],
    ];

    foreach ($datas as $data)
      Obj::create($data);
  }
}
