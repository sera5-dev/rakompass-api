<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = [
    'id',
    'name',
    'time',
    'description',
  ];
  protected $hidden = [
    'created_at',
    'updated_at',
  ];
}
