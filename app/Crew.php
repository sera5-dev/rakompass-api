<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
  protected $fillable = [
    'id',
    'name',
    'address',
    'birth_date',
    'birth_place',
  ];
  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function programs()
  {
    return $this->belongsToMany(User::class, 'crew_program');
  }

  public function social()
  {
    return $this->belongsToMany(Social::class, 'crew_social');
  }

  public function contacts()
  {
    return $this->belongsToMany(Contact::class, 'crew_contact');
  }
}
