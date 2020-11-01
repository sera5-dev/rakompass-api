<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Img;
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

  public function uploadImage($request, $obj)
  {
    if ($request->hasFile('image')) {

      $folder = Str::lower(class_basename($obj));
      $path = 'app/' . $folder . '/';

      if (!file_exists(storage_path($path) . $obj->id))
        File::makeDirectory(storage_path($path) . $obj->id);

      $img = new Image();
      $img->location = Str::random() . '.jpg';
      Img::make($request->file('image'))->fit(300)->save(storage_path($path) . $obj->id . '/' . Str::random() . '.jpg');
      $img->save();

      return $img->id;
    }
  }
}
