<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $fillable = [
    'id',
    'name',
    'icon',
  ];
  protected $hidden = [
    'created_at',
    'updated_at',
  ];
}
