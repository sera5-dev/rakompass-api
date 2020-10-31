<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
  public function __construct()
  {
    $obj = new Contact();
    $this->attr = $obj->getFillable();
  }

  public function index()
  {
    try {
      return $this->res('succeed', 'store', 200, Contact::all());
    } catch (\Exception $e) {
      return $this->res('failed', 'store', 403);
    }
  }

  public function show($id)
  {
    try {
      return $this->res('succeed', 'store', 200, Contact::findOrFail($id));
    } catch (\Exception $e) {
      return $this->res('failed', 'store', 403);
    }
  }

  public function store(Request $request)
  {
    try {
      $obj = new Contact();
      $this->save($request, $obj, $this->attr);
      return $this->res('succeed', 'store', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'store', 403);
    }
  }

  public function update(Request $request)
  {
    try {
      $obj = Contact::findOrFail($request->input('id'));
      $this->save($request, $obj, $this->attr);
      return $this->res('succeed', 'store', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'store', 403);
    }
  }

  public function destroy(Request $request)
  {
    try {
      $obj = Contact::findOrFail($request->input('id'));
      $obj->delete();
      return $this->res('succeed', 'store', 200);
    } catch (\Exception $e) {
      return $this->res('failed', 'store', 403);
    }
  }

  public function input(Request $request)
  {
    return $request->filled('id') ? $this->update($request) : $this->store($request);
  }
}
