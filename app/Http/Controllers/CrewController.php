<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crew;

class CrewController extends Controller
{
	public function index()
	{
		try {
			return response()->json([
				'data' => Crew::all(),
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
				'data' => Crew::findOrFail($id),
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
			$crew = new Crew();

			$this->save($request, $crew);

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
			$crew = Crew::findOrFail($request->input('id'));

			$this->save($request, $crew);

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
			$crew = Crew::findOrFail($request->input('id'));

			$crew->delete();

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

	static function save($request, $crew)
	{
		$crew->nama 					= $request->input('nama');
		$crew->alamat 				= $request->input('alamat');
		$crew->tempat_lahir		= $request->input('tempat_lahir');
		$crew->tanggal_lahir	= $request->input('alamat');

		$crew->save();
	}
}
