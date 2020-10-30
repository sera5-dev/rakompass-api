<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kontak;

class KontakController extends Controller
{
	public function index()
	{
		try {
			return response()->json([
				'data' => Kontak::all(),
				'message' => 'data successfully retrieved'
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'retrieve data failed'
			], 500);
		}
	}

	public function show($id)
	{
		try {
			return response()->json([
				'data' => Kontak::findOrFail($id),
				'message' => 'data successfully retrieved'
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'retrieve data failed'
			], 500);
		}
	}

	public function store(Request $request)
	{
		try {
			$kontak = new Kontak();

			$this->save($request, $kontak);

			return response()->json([
				'message' => 'data successfully stored'
			], 201);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'store data failed'
			], 500);
		}
	}

	public function update(Request $request)
	{
		try {
			$kontak = Kontak::findOrFail($request->input('id'));

			$this->save($request, $kontak);

			return response()->json([
				'message' => 'data successfully updated'
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'update data failed'
			], 500);
		}
	}

	public function destroy(Request $request)
	{
		try {
			$kontak = Kontak::findOrFail($request->input('id'));

			$kontak->delete();

			return response()->json([
				'message' => 'data successfully deleted'
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'delete data failed'
			], 500);
		}
	}

	public function input(Request $request)
	{
		return $request->filled('id') ? $this->update($request) : $this->store($request);
	}

	static function save($request, $kontak)
	{
		$kontak->nama 	= $request->input('nama');
		$kontak->icon 	= $request->input('icon');

		$kontak->save();
	}
}
