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
    'theme',
  ];
  protected $hidden = [
    'created_at',
    'updated_at',
  ];
  public function schedules()
  {
    return $this->belongsTo(Schedule::class);
  }
}
