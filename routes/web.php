<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
	return $router->app->version();
});

$router->group(['prefix' => 'crews'], function ($router) {
	$router->get('/', 				'CrewController@index');
	$router->get('/{id}', 		'CrewController@show');
	$router->post('/', 				'CrewController@input');
	$router->delete('/', 			'CrewController@destroy');
});

$router->group(['prefix' => 'users'], function ($router) {
	$router->get('/', 				'UserController@index');
	$router->get('/{id}', 		'UserController@show');
	$router->post('/', 				'UserController@input');
	$router->delete('/', 			'UserController@destroy');
});

$router->group(['prefix' => 'programs'], function ($router) {
	$router->get('/', 							'ProgramController@index');
	$router->get('/{id}', 					'ProgramController@show');
	$router->get('/{id}/jadwals',		'ProgramController@jadwals');
	$router->get('/{id}/episodes', 	'ProgramController@episodes');
	$router->get('/{id}/crews', 		'ProgramController@crews');
	$router->post('/', 							'ProgramController@input');
	$router->post('/{id}/crews', 		'ProgramController@storeCrew');
	$router->delete('/', 						'ProgramController@destroy');
	$router->delete('/{id}/crews', 	'ProgramController@destroyCrew');
});

$router->group(['prefix' => 'jadwals'], function ($router) {
	$router->get('/', 				'JadwalController@index');
	$router->get('/{id}', 		'JadwalController@show');
	$router->post('/', 				'JadwalController@input');
	$router->delete('/', 			'JadwalController@destroy');
});

$router->group(['prefix' => 'episodes'], function ($router) {
	$router->get('/', 				'EpisodeController@index');
	$router->get('/{id}', 		'EpisodeController@show');
	$router->post('/', 				'EpisodeController@input');
	$router->delete('/', 			'EpisodeController@destroy');
});

$router->group(['prefix' => 'contacts'], function ($router) {
	$router->get('/', 				'KontakController@index');
	$router->get('/{id}', 		'KontakController@show');
	$router->post('/', 				'KontakController@input');
	$router->delete('/', 			'KontakController@destroy');
});

$router->group(['prefix' => 'socials'], function ($router) {
	$router->get('/', 				'SocialController@index');
	$router->get('/{id}', 		'SocialController@show');
	$router->post('/', 				'SocialController@input');
	$router->delete('/', 			'SocialController@destroy');
});
