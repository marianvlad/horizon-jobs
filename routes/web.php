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
	$currentKey = app('files')->get(base_path('key.job'));
	$output = app('files')->get(base_path('output.log'));

    return view('welcome', compact('currentKey', 'output'));
});

Route::get('/test', function () {
	sleep(mt_rand(5, 10));

	return 'ok';
})->name('test');
