<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
  protected $fillable = [
    'id',
    'name',
    'description',
  ];
  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function crews()
  {
    return $this->belongsToMany(Crew::class, 'crew_program');
  }

  public function schedules()
  {
    return $this->hasMany(Schedule::class);
  }

  public function episodes()
  {
    return $this->hasManyThrough(Episode::class, Schedule::class);
  }

  public static function allDetails()
  {
    $data = [];

    $program = Program::all();

    foreach ($program as $pk => $p) {
      $schedule = Program::findOrFail($p->id)->schedules;
      $episode = Program::findOrFail($p->id)->episodes;
      $crew = Program::findOrFail($p->id)->crews;

      $data[$pk]['id'] = $p->id;
      $data[$pk]['name'] = $p->name;
      $data[$pk]['description'] = $p->description;

      foreach ($schedule as $jk => $j) {
        $data[$pk]['schedule'][$jk]['id'] = $j->id;
        $data[$pk]['schedule'][$jk]['program_id'] = $j->program_id;
        $data[$pk]['schedule'][$jk]['day'] = $j->day;
        $data[$pk]['schedule'][$jk]['from'] = $j->from;
        $data[$pk]['schedule'][$jk]['until'] = $j->until;
      }

      foreach ($episode as $ek => $e) {
        $data[$pk]['episode'][$ek]['id'] = $e->id;
        $data[$pk]['episode'][$ek]['schedule_id'] = $e->schedule_id;
        $data[$pk]['episode'][$ek]['link'] = $e->link;
        $data[$pk]['episode'][$ek]['episode'] = $e->episode;
        $data[$pk]['episode'][$ek]['theme'] = $e->theme;
      }

      foreach ($crew as $ck => $c) {
        $data[$pk]['crew'][$ck]['id'] = $c->id;
        $data[$pk]['crew'][$ck]['name'] = $c->name;
      }
    }
    return $data;
  }

  public static function showDetails($id)
  {
    $data = [];

    $program = Program::findOrFail($id);
    $schedule = Program::findOrFail($id)->schedules;
    $episode = Program::findOrFail($id)->episodes;
    $crew = Program::findOrFail($id)->crews;

    $data['id'] = $program->id;
    $data['name'] = $program->name;
    $data['description'] = $program->description;

    foreach ($schedule as $jk => $j) {
      $data['schedule'][$jk]['id'] = $j->id;
      $data['schedule'][$jk]['program_id'] = $j->program_id;
      $data['schedule'][$jk]['day'] = $j->day;
      $data['schedule'][$jk]['from'] = $j->from;
      $data['schedule'][$jk]['until'] = $j->until;
    }

    foreach ($episode as $ek => $e) {
      $data['episode'][$ek]['id'] = $e->id;
      $data['episode'][$ek]['schedule_id'] = $e->schedule_id;
      $data['episode'][$ek]['link'] = $e->link;
      $data['episode'][$ek]['episode'] = $e->episode;
      $data['episode'][$ek]['theme'] = $e->theme;
    }

    foreach ($crew as $ck => $c) {
      $data['crew'][$ck]['id'] = $c->id;
      $data['crew'][$ck]['name'] = $c->name;
    }
    return $data;
  }
}
