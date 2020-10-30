<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;

class JadwalController extends Controller
{
	public function index()
	{
		try {
			return response()->json([
				'data' => Jadwal::all(),
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
				'data' => Jadwal::findOrFail($id),
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
			$jadwal = new Jadwal();

			$this->save($request, $jadwal);

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
			$jadwal = Jadwal::findOrFail($request->input('id'));

			$this->save($request, $jadwal);

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
			$jadwal = Jadwal::findOrFail($request->input('id'));

			$jadwal->delete();

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

	static function save($request, $jadwal)
	{
		$jadwal->hari 				= $request->input('hari');
		$jadwal->program_id 	= $request->input('program');
		$jadwal->dari 				= $request->input('dari');
		$jadwal->sampai 			= $request->input('sampai');

		$jadwal->save();
	}
}
