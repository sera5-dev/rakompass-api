<?php

namespace App\Http\Controllers;

use App\Social as Obj;
use Illuminate\Http\Request;

class SocialController extends Controller
{
  public function __construct()
  {
    $obj = new Obj();
    $this->attr = $obj->getFillable();
  }

  public function index()
  {
    try {
      return $this->res('succeed', 'retrieve', Obj::all());
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve');
    }
  }

  public function show($id)
  {
    try {
      return $this->res('succeed', 'retrieve', Obj::findOrFail($id));
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

  public function input(Request $request)
  {
    return $request->filled('id') ? $this->update($request) : $this->store($request);
  }
}
