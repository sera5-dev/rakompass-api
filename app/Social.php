<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
	protected $fillable = [
		'id',
		'nama',
		'icon',
	];
	protected $hidden = [
		'created_at',
		'updated_at',
	];
}
