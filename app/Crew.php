<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
	protected $fillable = [
		'id',
		'nama',
		'alamat',
		'tempat_lahir',
		'tanggal_lahir',
	];
	protected $hidden = [
		'created_at',
		'updated_at',
	];

	public function programs()
	{
		return $this->belongsToMany(User::class, 'crew_program');
	}
}
