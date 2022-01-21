<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
	if (Auth::check()) {
		return redirect()->route('home');
	}
	return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/capitanes', 'App\Http\Controllers\CapitanesController@index')->name('capitanes');
Route::get('/jugadores', 'App\Http\Controllers\JugadoresController@index')->name('jugadores');
Route::get('/consulta', 'App\Http\Controllers\ConsultaController@index')->name('consulta');

Route::post('/capitanes', 'App\Http\Controllers\CapitanesController@store')->name('capitanes.store');

Route::post('/jugadores', 'App\Http\Controllers\JugadoresController@store')->name('jugadores.store');

Route::get('/searchcapitan/{cedula}', 'App\Http\Controllers\JugadoresController@searchcapitan')->name('jugadores.searchcapitan');

Route::get('/searchjugadores/{cedula}', 'App\Http\Controllers\ConsultaController@searchjugadores')->name('consulta.searchjugadores');






Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
	Route::get('map', function () {
		return view('pages.maps');
	})->name('map');
	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');
	Route::get('table-list', function () {
		return view('pages.tables');
	})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
