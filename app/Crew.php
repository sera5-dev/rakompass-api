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

  public function images()
  {
    return $this->belongstomany(Image::class, 'crew_avatar');
  }

  public function socials()
  {
    return $this->belongsToMany(Social::class, 'crew_social')->withPivot('id', 'username');
  }

  public function contacts()
  {
    return $this->belongstomany(Contact::class, 'crew_contact')->withpivot('id', 'value');
  }

  public static function allDetails()
  {
    $data = [];
    $crew = Crew::all();

    foreach ($crew as $i => $crew) {
      $data[$i]['id'] = $crew->id;
      $data[$i]['name'] = $crew->name;
      $data[$i]['address'] = $crew->address;
      $data[$i]['birth_date'] = $crew->birth_date;
      $data[$i]['birth_place'] = $crew->birth_place;

      $image = Crew::findOrFail($crew->id)->images->first();
      if ($image)
        $data[$i]['avatar'] = $image->location;

      $social = Crew::findOrFail($crew->id)->socials;
      foreach ($social as $sk => $social) {
        $data[$i]['social'][$sk]['id'] = $social->id;
        $data[$i]['social'][$sk]['name'] = $social->name;
        $data[$i]['social'][$sk]['username'] = $social->pivot->username;
      }

      $contact = Crew::findOrFail($crew->id)->contacts;
      foreach ($contact as $ct => $contact) {
        $data[$i]['contact'][$ct]['id'] = $contact->id;
        $data[$i]['contact'][$ct]['name'] = $contact->name;
        $data[$i]['contact'][$ct]['value'] = $contact->pivot->value;
      }
    }

    return $data;
  }

  public static function showDetails($id)
  {
    $data = [];
    $crew = Crew::findOrFail($id);

    $data['id'] = $crew->id;
    $data['name'] = $crew->name;
    $data['address'] = $crew->address;
    $data['birth_date'] = $crew->birth_date;
    $data['birth_place'] = $crew->birth_place;

    $social = Crew::findOrFail($id)->socials;
    foreach ($social as $sk => $social) {
      $data['social'][$sk]['id'] = $social->id;
      $data['social'][$sk]['name'] = $social->name;
      $data['social'][$sk]['username'] = $social->pivot->username;
    }

    $contact = Crew::findOrFail($id)->contacts;
    foreach ($contact as $ct => $contact) {
      $data['contact'][$ct]['id'] = $contact->id;
      $data['contact'][$ct]['name'] = $contact->name;
      $data['contact'][$ct]['value'] = $contact->pivot->value;
    }

    $image = Crew::findOrFail($crew->id)->images->first();
    if ($image)
      $data['avatar'] = $image->location;

    return $data;
  }
}
