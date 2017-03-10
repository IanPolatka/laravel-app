<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/api/years', 'YearsController@showall');




//  Years
Route::get('/years', 'YearsController@index');

Route::get('years/create', 'YearsController@create');
Route::post('years/', 'YearsController@store');

Route::get('/years/{year}/edit', 'YearsController@edit');
Route::patch('/years/{year}', 'YearsController@update');

Route::get('years/{year}', 'YearsController@show');
Route::delete('years/{year}', 'YearsController@delete');



//  Game Times
Route::get('/times', 'TimesController@index');

Route::get('times/create', 'TimesController@create');
Route::post('times/', 'TimesController@store');

Route::get('/times/{time}/edit', 'TimesController@edit');
Route::patch('/times/{time}', 'TimesController@update');

Route::get('times/{time}', 'TimesController@show');
Route::delete('times/{time}', 'TimesController@delete');



//  Teams
Route::get('/teams', 'TeamsController@index');

Route::get('/teams/create', 'TeamsController@create');
Route::post('/teams/', 'TeamsController@store');

Route::get('/teams/{team}/edit', 'TeamsController@edit');
Route::patch('/teams/{team}', 'TeamsController@update');

Route::get('/teams/{team}', 'TeamsController@show');
Route::delete('/teams/{team}', 'TeamsController@delete');



//  Current Year
Route::get('/current-year/', 'CurrentyearController@index');
Route::get('/current-year/{currentyear}', 'CurrentyearController@show');



