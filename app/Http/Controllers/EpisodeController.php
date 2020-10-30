<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Episode;

class EpisodeController extends Controller
{
	public function index()
	{
		try {
			return response()->json([
				'data' => Episode::all(),
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
				'data' => Episode::findOrFail($id),
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
			$episode = new Episode();

			$this->save($request, $episode);

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
			$episode = Episode::findOrFail($request->input('id'));

			$this->save($request, $episode);

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
			$episode = Episode::findOrFail($request->input('id'));

			$episode->delete();

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

	static function save($request, $episode)
	{
		$episode->jadwal_id 	= $request->input('jadwal');
		$episode->link 				= $request->input('link');
		$episode->tema 				= $request->input('tema');
		$episode->episode 		= $request->input('episode');

		$episode->save();
	}
}
