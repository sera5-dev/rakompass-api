<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Social;

class SocialController extends Controller
{
	public function index()
	{
		try {
			return response()->json([
				'data' => Social::all(),
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
				'data' => Social::findOrFail($id),
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
			$social = new Social();

			$this->save($request, $social);

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
			$social = Social::findOrFail($request->input('id'));

			$this->save($request, $social);

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
			$social = Social::findOrFail($request->input('id'));

			$social->delete();

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

	static function save($request, $social)
	{
		$social->nama 	= $request->input('nama');
		$social->icon 	= $request->input('icon');

		$social->save();
	}
}
