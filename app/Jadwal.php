<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
	protected $fillable = [
		'id',
		'program_id',
		'hari',
		'dari',
		'sampai',
	];
	protected $hidden = [
		'created_at',
		'updated_at',
	];

	public function programs()
	{
		return $this->belongsTo(Program::class);
	}

	public function episodes()
	{
		return $this->hasMany(Jadwal::class);
	}
}
