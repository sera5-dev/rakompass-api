<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = [
    'id',
    'nama',
    'waktu',
    'deskripsi',
  ];
  protected $hidden = [
    'created_at',
    'updated_at',
  ];
}
