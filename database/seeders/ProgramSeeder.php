<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Program as Obj;

class ProgramSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $datas = [
      ['name' => 'Selamat Pagi Katapang'],
      ['name' => 'PAGODA'],
      ['name' => 'TEPAS'],
      ['name' => 'DASI'],
      ['name' => 'Pop Indonesia'],
      ['name' => 'Hararing Kuring'],
      ['name' => 'Murotal'],
      ['name' => 'Lembur Kuring'],
      ['name' => 'JAIPONG'],
      ['name' => 'Wayang Golek'],
      ['name' => 'Talk Show'],
      ['name' => 'Pass Malaysia'],
      ['name' => 'Gentra Pasundaan'],
      ['name' => 'Klasik Barat'],
      ['name' => 'Berseka'],
      ['name' => 'Mutiara Hikmah'],
      ['name' => 'Pass Serem'],
      ['name' => 'Campur Sari'],
      ['name' => 'Tetesan Hikmah'],
      ['name' => 'Mutiara Suna'],
      ['name' => 'Karaoke'],
      ['name' => 'Klasik Rock N Blues'],
      ['name' => 'India Koplo'],
      ['name' => 'Gentra Pasundan'],
      ['name' => 'Pencak Silat'],
      ['name' => 'Opera'],
      ['name' => 'RT.RW'],
      ['name' => 'Bahasa Remaja'],
      ['name' => 'Golden Memori'],
    ];

    foreach ($datas as $data)
      Obj::create($data);
  }
}
