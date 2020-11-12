<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Crew as Obj;

class CrewSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $datas = [
      ['name' => 'Sukma',],
      ['name' => 'Irsan',],
      ['name' => 'Santi',],
      ['name' => 'Fikri',],
      ['name' => 'Pak Yoyon',],
      ['name' => 'Dede',],
      ['name' => 'Widi',],
      ['name' => 'Jefri',],
      ['name' => 'Yudi',],
      ['name' => 'Gugun',],
      ['name' => 'Om Tema',],
      ['name' => 'Om Tema',],
      ['name' => 'Kang Ayi',],
      ['name' => 'Pak Agung',],
      ['name' => 'Mas Dimas',],
      ['name' => 'Mang Jey',],
      ['name' => 'Bah Opic',],
      ['name' => 'Ardian',],
      ['name' => 'Lufie',],
      ['name' => 'Shofyani',],
      ['name' => 'Ade Sawit',]
    ];

    foreach ($datas as $data)
      Obj::create($data);
  }
}
