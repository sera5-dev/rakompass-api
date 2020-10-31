<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
  public static function save($request, $obj, $data)
  {
    foreach ($data as $d) {
      if ($request->filled($d))
        $obj->$d = $request->input($d);
    }
    $obj->save();
  }

  public function res($status, $method, $data = '')
  {
    $status == 'succeed' ? $code = 200 : $code = 400;
    if ($method == 'retrieve') {
      return response()->json([
        'data' => $data,
        'message' => $status . ' to ' . $method . ' data',
      ], $code);
    } else {
      return response()->json([
        'message' => $status . ' to ' . $method . ' data',
      ], $code);
    }
  }
}
