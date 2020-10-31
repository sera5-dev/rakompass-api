<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Social;

class SocialController extends Controller
{
  public function __construct()
  {
    $obj = new Social();
    $this->attr = $obj->getFillable();
  }

  public function index()
  {
    try {
      return $this->res('succeed', 'retrieve', 200, Social::all());
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve', 403);
    }
  }

  public function show($id)
  {
    try {
      return $this->res('succeed', 'retrieve', 200, Social::findOrFail($id));
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve', 403);
    }
  }

  public function store(Request $request)
  {
    try {
      $obj = new Social();
      $this->save($request, $obj, $this->attr);
      return $this->res('succeed', 'store', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'store', 403);
    }
  }

  public function update(Request $request)
  {
    try {
      $obj = Social::findOrFail($request->input('id'));
      $this->save($request, $obj, $this->attr);
      return $this->res('succeed', 'update', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'update', 403);
    }
  }

  public function destroy(Request $request)
  {
    try {
      $obj = Social::findOrFail($request->input('id'));
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
