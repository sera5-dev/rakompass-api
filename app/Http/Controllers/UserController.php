<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function __construct()
  {
    $obj = new User;
    $this->attr = $obj->getFillable();
  }

  public function index()
  {
    try {
      return $this->res('succeed', 'retrieve', 200, User::all());
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve', 403);
    }
  }

  public function show($id)
  {
    try {
      return $this->res('succeed', 'retrieve', 200, User::findOrFail($id));
    } catch (\Exception $e) {
      return $this->res('failed', 'retrieve', 403);
    }
  }

  public function store(Request $request)
  {
    try {
      $user = new User();
      $this->userSave($request, $user);
      return $this->res('succeed', 'store', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'store', 403);
    }
  }

  public function update(Request $request)
  {
    try {
      $user = User::findOrFail($request->input('id'));
      $this->userSave($request, $user);
      return $this->res('succeed', 'update', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'update', 403);
    }
  }

  public function destroy(Request $request)
  {
    try {
      $user = User::findOrFail($request->input('id'));
      $user->delete();
      return $this->res('succeed', 'delete', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'delete', 403);
    }
  }

  public function input(Request $request)
  {
    return $request->filled('id') ? $this->update($request) : $this->store($request);
  }

  function userSave($request, $user)
  {
    foreach ($this->attr as $d) {
      if ($request->filled($d))
        $d == 'password' ?
          $user->$d = Hash::make($request->input($d)) :
          $user->d = $request->input($d);
    }
    $user->save();
  }
}
