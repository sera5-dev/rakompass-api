<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Obj;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
    $obj = new Obj();
    $this->attr = $obj->getFillable();
  }

  public function register(Request $request)
  {
    $this->validate($request, [
      'username'   => 'required|alpha_dash|unique:users',
      'password'   => 'required|confirmed',
    ]);

    try {
      $user = new Obj;
      $user->username = $request->input('username');
      $user->password = app('hash')->make($request->input('password'));
      $user->save();

      return response()->json([
        'message' => 'users successfully created',
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'create users failed',
      ], 409);
    }
  }

  public function login(Request $request)
  {
    $this->validate($request, [
      'username' => 'required|alpha_dash',
      'password' => 'required|string',
    ]);

    $credentials = $request->only(['username', 'password']);

    if (!$token = Auth::attempt($credentials)) {
      return response()->json([
        'message' => 'login failed'
      ], 401);
    }
    return response()->json([
      'token' => $token,
    ]);
  }

  public function logout()
  {
    try {
      Auth::logout();
      return response()->json([
        'data' => null,
        'message' => 'user successfully logged out'
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'user logout failed',
        'error' => $e,
      ], 409);
    }
  }

  public function unregister(Request $request)
  {
    try {
      Obj::findOrFail($request->input('id'))->delete();

      return response()->json([
        'message' => 'user successfully deleted',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'delete user failed',
        'error' => $e
      ]);
    }
  }
}
