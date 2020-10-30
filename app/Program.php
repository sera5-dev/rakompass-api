<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	protected $fillable = [
		'id',
		'nama',
		'deskripsi',
	];
	protected $hidden = [
		'created_at',
		'updated_at',
	];

	public function crews()
	{
		return $this->belongsToMany(Crew::class, 'crew_program');
	}

	public function jadwals()
	{
		return $this->hasMany(Jadwal::class);
	}

	public function episodes()
	{
		return $this->hasManyThrough(Episode::class, Jadwal::class);
	}

	public static function allDetails()
	{
		$data = [];

		$program 	= Program::all();

		foreach ($program as $pk => $p) {
			$jadwal 	= Program::findOrFail($p->id)->jadwals;
			$episode 	= Program::findOrFail($p->id)->episodes;
			$crew 		= Program::findOrFail($p->id)->crews;

			$data[$pk]['id'] 				= $p->id;
			$data[$pk]['nama'] 			= $p->nama;
			$data[$pk]['deskripsi']	= $p->deskripsi;

			foreach ($jadwal as $jk => $j) {
				$data[$pk]['jadwal'][$jk]['id'] 				= $j->id;
				$data[$pk]['jadwal'][$jk]['program_id']	= $j->program_id;
				$data[$pk]['jadwal'][$jk]['hari'] 			= $j->hari;
				$data[$pk]['jadwal'][$jk]['dari'] 			= $j->dari;
				$data[$pk]['jadwal'][$jk]['sampai']			= $j->sampai;
			}

			foreach ($episode as $ek => $e) {
				$data[$pk]['episode'][$ek]['id'] 				= $e->id;
				$data[$pk]['episode'][$ek]['jadwal_id']	= $e->jadwal_id;
				$data[$pk]['episode'][$ek]['link'] 			= $e->link;
				$data[$pk]['episode'][$ek]['episode'] 	= $e->episode;
				$data[$pk]['episode'][$ek]['tema'] 			= $e->tema;
			}

			foreach ($crew as $ck => $c) {
				$data[$pk]['crew'][$ck]['id'] 		= $c->id;
				$data[$pk]['crew'][$ck]['nama'] 	= $c->nama;
			}
		}
		return $data;
	}

	public static function showDetails($id)
	{
		$data = [];

		$program 	= Program::findOrFail($id);
		$jadwal 	= Program::findOrFail($id)->jadwals;
		$episode 	= Program::findOrFail($id)->episodes;
		$crew 		= Program::findOrFail($id)->crews;

		$data['id'] 				= $program->id;
		$data['nama'] 			= $program->nama;
		$data['deskripsi'] 	= $program->deskripsi;

		foreach ($jadwal as $jk => $j) {
			$data['jadwal'][$jk]['id'] 					= $j->id;
			$data['jadwal'][$jk]['program_id'] 	= $j->program_id;
			$data['jadwal'][$jk]['hari'] 				= $j->hari;
			$data['jadwal'][$jk]['dari'] 				= $j->dari;
			$data['jadwal'][$jk]['sampai']			= $j->sampai;
		}

		foreach ($episode as $ek => $e) {
			$data['episode'][$ek]['id'] 				= $e->id;
			$data['episode'][$ek]['jadwal_id'] 	= $e->jadwal_id;
			$data['episode'][$ek]['link'] 			= $e->link;
			$data['episode'][$ek]['episode'] 		= $e->episode;
			$data['episode'][$ek]['tema'] 			= $e->tema;
		}

		foreach ($crew as $ck => $c) {
			$data['crew'][$ck]['id'] 		= $c->id;
			$data['crew'][$ck]['nama'] 	= $c->nama;
		}
		return $data;
	}
}
