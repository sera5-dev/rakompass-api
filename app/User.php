<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $fillable = [
    'username',
    'password',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];
}
