<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\User as Obj;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $datas = [
      [
        'username' => 'admin',
        'password' => Hash::make('admin'),
      ],
      [
        'username' => 'rifqisambas',
        'password' => Hash::make('admin'),
      ],
    ];

    foreach ($datas as $data)
      Obj::create($data);
  }
}
