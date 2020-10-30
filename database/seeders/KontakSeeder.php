<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Kontak;

class KontakSeeder extends Seeder
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
			$kontak = new Kontak;
			$kontak->nama = $d;
			$kontak->save();
		}
	}
}
