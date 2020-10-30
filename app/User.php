<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $fillable = [
		'username',
	];

	protected $hidden = [
		'password',
		'created_at',
		'updated_at',
	];
}
