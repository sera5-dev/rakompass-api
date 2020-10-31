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
  $router->get('/', 'CrewController@index');
  $router->get('/{id}', 'CrewController@show');
  $router->post('/', 'CrewController@input');
  $router->delete('/', 'CrewController@destroy');
});

$router->group(['prefix' => 'users'], function ($router) {
  $router->get('/', 'UserController@index');
  $router->get('/{id}', 'UserController@show');
  $router->post('/', 'UserController@input');
  $router->delete('/', 'UserController@destroy');
});

$router->group(['prefix' => 'programs'], function ($router) {
  $router->get('/', 'ProgramController@index');
  $router->get('/{id}', 'ProgramController@show');
  $router->get('/{id}/schedules', 'ProgramController@schedules');
  $router->get('/{id}/episodes', 'ProgramController@episodes');
  $router->get('/{id}/crews', 'ProgramController@crews');
  $router->post('/', 'ProgramController@input');
  $router->post('/{id}/crews', 'ProgramController@storeCrew');
  $router->delete('/', 'ProgramController@destroy');
  $router->delete('/{id}/crews', 'ProgramController@destroyCrew');
});

$router->group(['prefix' => 'schedules'], function ($router) {
  $router->get('/', 'ScheduleController@index');
  $router->get('/{id}', 'ScheduleController@show');
  $router->post('/', 'ScheduleController@input');
  $router->delete('/', 'ScheduleController@destroy');
});

$router->group(['prefix' => 'episodes'], function ($router) {
  $router->get('/', 'EpisodeController@index');
  $router->get('/{id}', 'EpisodeController@show');
  $router->post('/', 'EpisodeController@input');
  $router->delete('/', 'EpisodeController@destroy');
});

$router->group(['prefix' => 'contacts'], function ($router) {
  $router->get('/', 'ContactController@index');
  $router->get('/{id}', 'ContactController@show');
  $router->post('/', 'ContactController@input');
  $router->delete('/', 'ContactController@destroy');
});

$router->group(['prefix' => 'socials'], function ($router) {
  $router->get('/', 'SocialController@index');
  $router->get('/{id}', 'SocialController@show');
  $router->post('/', 'SocialController@input');
  $router->delete('/', 'SocialController@destroy');
});

$router->group(['prefix' => 'events'], function ($router) {
  $router->get('/', 'EventController@index');
  $router->get('/{id}', 'EventController@show');
  $router->post('/', 'EventController@input');
  $router->delete('/', 'EventController@destroy');
});

$router->group(['prefix' => 'abouts'], function ($router) {
  $router->get('/', 'AboutController@index');
  $router->get('/{id}', 'AboutController@show');
  $router->post('/', 'AboutController@input');
  $router->delete('/', 'AboutController@destroy');
});
