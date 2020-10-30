<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Crew;

class CrewSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$crew 						= new Crew();
		$crew->nama 			= 'Rifqi';
		$crew->save();
	}
}
