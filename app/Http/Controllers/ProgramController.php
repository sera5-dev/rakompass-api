<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
  public function __construct()
  {
    $obj = new Program();
    $this->attr = $obj->getFillable();
  }

  public function index()
  {
    try {
      return $this->res('succeed', 'retrieve', 200, Program::all());
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve', 403);
    }
  }

  public function show($id)
  {
    try {
      return $this->res('succeed', 'retrieve', 200, Program::findOrFail($id));
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve', 403);
    }
  }

  public function store(Request $request)
  {
    try {
      $obj = new Program();
      $this->save($request, $obj, $this->attr);
      return $this->res('succeed', 'store', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'store', 403);
    }
  }

  public function update(Request $request)
  {
    try {
      $obj = Program::findOrFail($request->input('id'));
      $this->save($request, $obj, $this->attr);
      return $this->res('succeed', 'update', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'update', 403);
    }
  }

  public function destroy(Request $request)
  {
    try {
      $obj = Program::findOrFail($request->input('id'));
      $obj->delete();
      return $this->res('succeed', 'delete', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'delete', 403);
    }
  }

  public function input(Request $request)
  {
    return $request->filled('id') ? $this->update($request) : $this->store($request);
  }
}
