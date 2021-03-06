<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
  protected $fillable = [
    'id',
    'name',
    'address',
    'history',
  ];
  protected $hidden = [
    'created_at',
    'updated_at',
  ];
}
