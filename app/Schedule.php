<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  protected $fillable = [
    'id',
    'program_id',
    'day',
    'start',
    'end',
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
    return $this->hasMany(Episode::class);
  }
}
