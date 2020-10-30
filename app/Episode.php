<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
	protected $fillable = [
		'id',
		'jadwal_id',
		'link',
		'episode',
		'tema',
	];
	protected $hidden = [
		'created_at',
		'updated_at',
	];
	public function jadwals()
	{
		return $this->belongsTo(Jadwal::class);
	}
}
