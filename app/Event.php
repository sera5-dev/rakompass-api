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

  public function images()
  {
    return $this->belongstomany(Image::class, 'event_image');
  }

  public static function allDetails()
  {
    $data = [];
    $obj = Event::all();

    foreach ($obj as $i => $obj) {
      $data[$i]['id'] = $obj->id;
      $data[$i]['name'] = $obj->name;
      $data[$i]['time'] = $obj->time;
      $data[$i]['description'] = $obj->description;

      $image = Event::findOrFail($obj->id)->images->first();
      if ($image)
        $data[$i]['image'] = $image->location;
    }

    return $data;
  }

  public static function showDetails($id)
  {
    $data = [];
    $obj = Event::findOrFail($id);

    $data['id'] = $obj->id;
    $data['name'] = $obj->name;
    $data['time'] = $obj->time;
    $data['description'] = $obj->description;

    $image = Event::findOrFail($obj->id)->images->first();
    if ($image)
      $data['image'] = $image->location;

    return $data;
  }
}
