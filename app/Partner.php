<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
  protected $fillable = [
    'id',
    'name',
    'address',
    'description',
  ];
  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function images()
  {
    return $this->belongstomany(Image::class, 'partner_image');
  }

  public static function allDetails()
  {
    $data = [];
    $obj = Partner::all();

    foreach ($obj as $i => $obj) {
      $data[$i]['id'] = $obj->id;
      $data[$i]['name'] = $obj->name;
      $data[$i]['address'] = $obj->address;
      $data[$i]['description'] = $obj->description;

      $image = Partner::findOrFail($obj->id)->images->first();
      $data[$i]['image'] = $image->location;
    }

    return $data;
  }

  public static function showDetails($id)
  {
    $data = [];
    $obj = Partner::findOrFail($id);

    $data['id'] = $obj->id;
    $data['name'] = $obj->name;
    $data['address'] = $obj->address;
    $data['description'] = $obj->description;

    $image = Partner::findOrFail($obj->id)->images->first();
    if ($image)
      $data['image'] = $image->location;

    return $data;
  }
}
