<?php

namespace App\Http\Controllers;

use App\Crew;
use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
	public function index()
	{
		try {
			return response()->json([
				'data' => Program::allDetails(),
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
				'data' => Program::showDetails($id),
				'message' => 'data successfully retrieved'
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'retrieve data failed'
			], 500);
		}
	}

	public function jadwals($id)
	{
		try {
			return response()->json([
				'data' => Program::findOrFail($id)->jadwals,
				'message' => 'data successfully retrieved'
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'retrieve data failed'
			], 500);
		}
	}

	public function episodes($id)
	{
		try {
			return response()->json([
				'data' => Program::findOrFail($id)->episodes,
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
			$program = new Program();

			$this->save($request, $program);

			return response()->json([
				'message' => 'data successfully stored'
			], 201);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'store data failed'
			], 500);
		}
	}

	public function storeCrew(Request $request, $id)
	{
		try {
			$program = Program::findOrFail($id);
			$program->crews()->attach($request->input('crew'));

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
			$program = Program::findOrFail($request->input('id'));

			$this->save($request, $program);

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
			$program = Program::findOrFail($request->input('id'));
			$program->delete();

			return response()->json([
				'message' => 'data successfully deleted'
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'delete data failed'
			], 500);
		}
	}

	public function destroyCrew(Request $request, $id)
	{
		try {
			$program = Program::findOrFail($id);
			$program->crews()->sync([]);

			return response()->json([
				'message' => 'data successfully deleted'
			], 201);
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

	static function save($request, $program)
	{
		$program->nama 			= $request->input('nama');
		$program->deskripsi = $request->input('deskripsi');

		$program->save();
	}
}
