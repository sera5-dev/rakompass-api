<?php

namespace App\Http\Controllers;

use App\Crew as Obj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrewController extends Controller
{
  public function __construct()
  {
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
      $obj = new Obj;
      $this->save($request, $obj, $this->attr);
      if ($request->hasFile('image'))
        Obj::findOrFail($obj->id)->images()->attach($this->uploadImage($request, $obj));
      return $this->res('succeed', 'store');
    } catch (\Exception $e) {
      return $this->res('failed', 'store');
    }
  }

  public function update(Request $request)
  {
    try {
      $obj = Obj::findOrFail($request->input('id'));
      $this->save($request, $obj, $this->attr);
      if ($request->hasFile('image'))
        Obj::findOrFail($obj->id)->images()->attach($this->uploadImage($request, $obj));
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

  public function contacts($id)
  {
    try {
      return $this->res('succeed', 'retrieve', Obj::findOrFail($id)->contacts);
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve');
    }
  }

  public function socials($id)
  {
    try {
      return $this->res('succeed', 'retrieve', Obj::findOrFail($id)->socials);
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve');
    }
  }

  public function storeContacts(Request $request, $id)
  {
    try {
      Obj::findOrFail($id)->contacts()->attach(
        $request->input('contact_id'),
        ['value' => $request->input('value')]
      );
      return $this->res('succeed', 'store');
    } catch (\Exception $e) {
      return $this->res('failed', 'store');
    }
  }

  public function storeSocials(Request $request, $id)
  {
    try {
      Obj::findOrFail($id)->socials()->attach(
        $request->input('social_id'),
        ['username' => $request->input('username')]
      );
      return $this->res('succeed', 'store');
    } catch (\Exception $e) {
      return $this->res('failed', 'store');
    }
  }

  public function destroyContacts(Request $request, $id)
  {
    try {
      DB::table('crew_contact')->where([
        'id' => $request->input('id'),
        'crew_id' => $id,
      ])->delete();
      return $this->res('succeed', 'delete');
    } catch (\Exception $e) {
      return $this->res('failed', 'delete');
    }
  }

  public function destroySocials(Request $request, $id)
  {
    try {
      DB::table('crew_social')->where([
        'id' => $request->input('id'),
        'crew_id' => $id,
      ])->delete();
      return $this->res('succeed', 'delete');
    } catch (\Exception $e) {
      return $this->res('failed', 'delete');
    }
  }
}
