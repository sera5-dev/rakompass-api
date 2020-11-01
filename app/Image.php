<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $fillable = [
    'id',
    'location',
  ];
  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function crews()
  {
    return $this->belongsToMany(Crews::class, 'crew_avatar');
  }
}
