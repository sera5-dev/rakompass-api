<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\User as Obj;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
    $obj = new Obj;
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

  public function update(Request $request)
  {
    if ($request->filled('password')) {
      $this->validate($request, [
        'username' => 'required|alpha_dash',
        'password' => 'required|confirmed',
        'password_current' => 'required',
      ]);
    } else {
      $this->validate($request, [
        'username' => 'required|alpha_dash',
        'password_current' => 'required',
      ]);
    }
    try {
      $user = Obj::findOrFail($request->input('id'));

      if (Hash::check($request->input('password_current'), $user->password)) {
        $user->username = $request->input('username');
        if ($request->filled('password')) {
          $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        return response()->json([
          'message' => 'succeed to update data',
        ], 201);
      } else {
        return response()->json([
          'message' => 'wrong current password',
        ], 400);
      }
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'create users updated',
      ], 400);
    }
  }

  public function destroy(Request $request)
  {
    try {
      $user = Obj::findOrFail($request->input('id'));
      $user->delete();
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
