<?php

namespace App\Http\Controllers;

use App\Crew;
use App\Program as Obj;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['index', 'show', 'schedules', 'episodes']]);
    $obj = new Obj();
    $this->attr = $obj->getFillable();
  }

  public function input(Request $request)
  {
    return $request->filled('id') ? $this->update($request) : $this->store($request);
  }

  public function index()
  {
    try {
      return $this->res('succeed', 'retrieve', Obj::allDetails());
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve');
    }
  }

  public function show($id)
  {
    try {
      return $this->res('succeed', 'retrieve', Obj::showDetails($id));
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve');
    }
  }

  public function store(Request $request)
  {
    try {
      $this->save($request, new Obj, $this->attr);
      return $this->res('succeed', 'store');
    } catch (\Exception $e) {
      return $this->res('failed', 'store');
    }
  }

  public function update(Request $request)
  {
    try {
      $this->save($request, Obj::findOrFail($request->input('id')), $this->attr);
      return $this->res('succeed', 'update');
    } catch (\Exception $e) {
      return $this->res('failed', 'update');
    }
  }

  public function destroy(Request $request)
  {
    try {
      Obj::findOrFail($request->input('id'))->delete();
      return $this->res('succeed', 'delete');
    } catch (\Exception $e) {
      return $this->res('failed', 'delete');
    }
  }

  public function schedules($id)
  {
    try {
      return $this->res('succeed', 'retrieve', Obj::findOrFail($id)->schedules);
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve');
    }
  }

  public function episodes($id)
  {
    try {
      return $this->res('succeed', 'retrieve', Obj::findOrFail($id)->episodes);
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve');
    }
  }

  public function crews($id)
  {
    try {
      return $this->res('succeed', 'retrieve', Obj::findOrFail($id)->crews);
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve');
    }
  }

  public function crewsOption($id)
  {
    try {
      $data = Obj::findOrFail($id)->crews->pluck('id')->toArray();
      $crews = Crew::all()->except($data);
      return $this->res('succeed', 'retrieve', $crews);
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve');
    }
  }

  public function storeCrew(Request $request, $id)
  {
    try {
      Obj::findOrFail($id)->crews()->attach($request->input('crew_id'));
      return $this->res('succeed', 'store');
    } catch (\Exception $e) {
      return $this->res('failed', 'store');
    }
  }

  public function destroyCrew(Request $request, $id)
  {
    try {
      Obj::findOrFail($id)->crews()->detach($request->input('crew_id'));
      return $this->res('succeed', 'delete');
    } catch (\Exception $e) {
      return $this->res('failed', 'delete');
    }
  }
}
