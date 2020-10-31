<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Contact;

class ContactSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      'ponsel',
      'telepon',
      'email',
      'fax',
    ];

    foreach ($data as $d) {
      $kontak = new Contact;
      $kontak->name = $d;
      $kontak->save();
    }
  }
}
