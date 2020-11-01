<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
  protected $fillable = [
    'id',
    'schedule_id',
    'link',
    'episode',
    'theme',
    'date',
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
